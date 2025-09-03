#!/usr/bin/env bash
set -euo pipefail

# normalize_docs_case.sh
# Enforce lowercase names for all files and folders under docs/ directories,
# except README.md which must remain exactly README.md.
#
# Usage:
#   bash normalize_docs_case.sh [--dry-run] [--target PATH] [--target PATH2 ...]
#
# Defaults (if no --target provided):
#   ./docs
#   ./laravel/docs
#   ./laravel/Modules/*/docs
#
# Notes:
# - Operates depth-first so children are renamed before parents.
# - Skips any path whose basename is exactly README.md.
# - Produces a mapping report of OldPath -> NewPath.
# - Idempotent and safe to re-run.

DRY_RUN=false
TARGETS=()

while [[ $# -gt 0 ]]; do
  case "$1" in
    --dry-run)
      DRY_RUN=true; shift ;;
    --target)
      TARGETS+=("$2"); shift 2 ;;
    *) echo "Unknown argument: $1" >&2; exit 1 ;;
  esac
done

if [ ${#TARGETS[@]} -eq 0 ]; then
  TARGETS=(
    "./docs"
    "./laravel/docs"
    ./laravel/Modules/*/docs
  )
fi

log(){ printf "%s\n" "$*"; }
run(){ if $DRY_RUN; then log "DRY: $*"; else eval "$*"; fi }

lowercase(){ tr 'A-Z' 'a-z'; }

process_base(){
  local base="$1"
  [ -d "$base" ] || return 0
  log "Processing: $base"

  # Collect items with uppercase, deepest first, excluding README.md
  mapfile -t items < <(find "$base" -depth \
    -regex ".*[A-Z].*" \
    -not -name "README.md")

  if [ ${#items[@]} -eq 0 ]; then
    log "No uppercase paths found in $base"
    return 0
  fi

  local mapping_file
  mapping_file="$(mktemp)"

  for p in "${items[@]}"; do
    bn="$(basename -- "$p")"
    dn="$(dirname -- "$p")"
    lbn="$(printf '%s' "$bn" | lowercase)"
    # Skip if already lowercase after filters
    if [[ "$bn" == "$lbn" ]]; then
      continue
    fi
    new="$dn/$lbn"

    # Handle conflicts: if target exists and is different path, skip with warning
    if [ -e "$new" ] && [ "$p" != "$new" ]; then
      log "WARN: target exists, skipping: $p -> $new"
      continue
    fi

    printf "%s -> %s\n" "$p" "$new" | tee -a "$mapping_file" >/dev/null
    run "mv -v -- '$p' '$new'"
  done

  log "Mapping for $base:"; cat "$mapping_file" || true
  rm -f "$mapping_file" || true
}

for t in "${TARGETS[@]}"; do
  # expand globs safely
  shopt -s nullglob
  for expanded in $t; do
    process_base "$expanded"
  done
  shopt -u nullglob
done

log "Done."
