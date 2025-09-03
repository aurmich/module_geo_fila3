#!/usr/bin/env bash
set -euo pipefail

REPO_ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")"/../.. && pwd)"
ROOT_DOCS_DIR="$REPO_ROOT_DIR/docs"

if [ -d "$ROOT_DOCS_DIR" ]; then
  echo "ERROR: Forbidden root docs/ directory detected at: $ROOT_DOCS_DIR" >&2
  echo "All documentation must live under Modules/<Module>/docs/ or docs_project/." >&2
  echo "Suggested migration:" >&2
  echo "  mkdir -p \"$REPO_ROOT_DIR/docs_project/_legacy_root_docs\"" >&2
  echo "  git mv \"$ROOT_DOCS_DIR/*\" \"$REPO_ROOT_DIR/docs_project/_legacy_root_docs/\" 2>/dev/null || rsync -a --remove-source-files \"$ROOT_DOCS_DIR/\" \"$REPO_ROOT_DIR/docs_project/_legacy_root_docs/\"" >&2
  echo "  rmdir \"$ROOT_DOCS_DIR\" 2>/dev/null || true" >&2
  exit 1
fi

echo "OK: No forbidden root docs/ directory found."