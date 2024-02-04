<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Page;
use Modules\Blog\Models\Post;
use Modules\Blog\Models\Profile;
use Modules\Blog\Models\Tag;
use Webmozart\Assert\Assert;

class ThemeComposer
{
    /**
     * Undocumented function..
     *
     * @return Collection<int, Post>
     */
    public function getPosts()
    {
        return Post::get();
    }

    /**
     * Undocumented function.
     *
     * @return Collection<int, Post>
     */
    public function getPostsByCategory(string $category_name)
    {
        return Post::whereHas('categories', static function (Builder $query) use ($category_name) {
            $query->where('title', 'like', $category_name);
        })
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();
    }

    /**
     * @return Post|null
     */
    public function latestPost()
    {
        // Latest post
        $latestPost = Post::where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        return $latestPost;
    }

    /**
     * Undocumented function.
     *
     * @return Collection<int, Post>
     */
    public function latestPosts()
    {
        // Latest posts
        $latestPosts = Post::where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        return $latestPosts;
    }

    /**
     * Show the most popular 3 posts based on upvotes.
     *
     * @return Collection<int, Post>
     */
    public function popularPosts()
    {
        $popularPosts = Post::query()
            ->leftJoin('upvote_downvotes', 'posts.id', '=', 'upvote_downvotes.post_id')
            ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
            ->where(static function ($query) {
                $query->whereNull('upvote_downvotes.is_upvote')
                    ->orWhere('upvote_downvotes.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->whereDate('published_at', '<', Carbon::now())
            ->orderByDesc('upvote_count')
            ->groupBy([
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.thumbnail',
                'posts.body',
                'posts.active',
                'posts.published_at',
                'posts.user_id',
                'posts.created_at',
                'posts.updated_at',
                'posts.meta_title',
                'posts.meta_description',
            ])
            ->limit(5)
            ->get();

        return $popularPosts;
    }

    /**
     * @return Collection<int, Post>
     */
    public function recommendedPosts()
    {
        $user = auth()->user();

        if ($user instanceof Authenticatable) {
            $leftJoin = '(SELECT cp.category_id, cp.post_id FROM upvote_downvotes
                        JOIN category_post cp ON upvote_downvotes.post_id = cp.post_id
                        WHERE upvote_downvotes.is_upvote = 1 and upvote_downvotes.user_id = ?) as t';
            $recommendedPosts = Post::query()
                ->leftJoin('category_post as cp', 'posts.id', '=', 'cp.post_id')
                ->leftJoin(DB::raw($leftJoin), static function ($join) {
                    $join->on('t.category_id', '=', 'cp.category_id')
                        ->on('t.post_id', '<>', 'cp.post_id');
                })
                ->select('posts.*')
                ->where('posts.id', '<>', DB::raw('t.post_id'))
                ->setBindings([$user->id])
                ->limit(3)
                ->get();
        } // Not authorized - Popular posts based on views
        else {
            $recommendedPosts = Post::query()
                ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->where('active', '=', 1)
                ->whereDate('published_at', '<', Carbon::now())
                ->orderByDesc('view_count')
                ->groupBy([
                    'posts.id',
                    'posts.title',
                    'posts.slug',
                    'posts.thumbnail',
                    'posts.body',
                    'posts.active',
                    'posts.published_at',
                    'posts.user_id',
                    'posts.created_at',
                    'posts.updated_at',
                    'posts.meta_title',
                    'posts.meta_description',
                ])
                ->limit(3)
                ->get();
        }

        return $recommendedPosts;
    }

    /**
     * Show recent categories with their latest posts.
     *
     * @return Collection<int, Category>
     */
    public function categories()
    {
        $categories = Category::tree()->get()->toTree();

        // $categories = Category::query()
        //     // ->with(['posts' => function ($query) {
        //     //     $query->orderByDesc('published_at');
        //     // }])
        //     ->whereHas('posts', static function ($query) {
        //         $query
        //             ->where('active', '=', 1)
        //             ->whereDate('published_at', '<', Carbon::now());
        //     })
        //     ->select('categories.*')
        //     ->selectRaw('MAX(posts.published_at) as max_date')
        //     ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
        //     ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
        //     ->orderByDesc('max_date')
        //     ->groupBy([
        //         'categories.id',
        //         'categories.title',
        //         'categories.slug',
        //         'categories.created_at',
        //         'categories.updated_at',
        //     ])
        //     ->limit(5)
        // ->get();

        return $categories;
    }

    public function getArticles(): Collection
    {
        return Article::all()
            ->sortBy(['created_at', 'desc'])
        ;
    }

    public function getArticlesType(string $type, int $number = 6): Collection
    {
        $fun = 'get'.Str::studly($type).'Articles';

        return $this->{$fun}($number);
    }

    public function getFeaturedArticles(int $number = 6): Collection
    {
        $rows = Article::published()
            ->showHomepage()
            ->publishedUntilToday()
            ->take($number)
            ->orderBy('published_at', 'desc')
            ->get();
        if (0 === $rows->count()) {
            $rows = Article::get();
            // dddx($rows);
            Article::whereRaw('1=1')->update(['show_on_homepage' => true]);
        }

        return $rows;
    }

    public function getLatestArticles(int $number = 6): Collection
    {
        $rows = Article::published()
            ->publishedUntilToday()
            ->orderBy('published_at', 'desc')
            ->take($number)
            ->get();

        return $rows;
    }

    public function getAuthors(): Collection
    {
        $rows = Profile::ProfileIsAuthor()
            ->take(4)
            ->get();

        return $rows;
    }

    public function getNavCategories(): Collection
    {
        $navCategories = Category::has('posts', '>', 0)
            ->take(8)
            ->get();

        return $navCategories;
    }

    public function getFooterCategories(): Collection
    {
        $footerCategories = Category::has('posts', '>', 0)
            ->take(8)
            ->get();

        return $footerCategories;
    }

    public function getFooterAuthors(): Collection
    {
        $footerAuthors = Profile::profileIsAuthor()
            ->take(8)
            ->get();

        return $footerAuthors;
    }

    public function getTags(): Collection
    {
        return Tag::all();
    }

    public function getFooterTags(): Collection
    {
        $footerTags = Tag::take(15)->get();

        return $footerTags;
    }

    /**
     * @return \Illuminate\Support\Collection<(int|string), mixed>
     */
    public function getMoreArticles(Model $model)
    {
        return collect([]);
    }

    /**
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedArticles(int $num = 15)
    {
        // return collect([]);
        return $this->getArticles()
                ->paginate($num);
    }

    public function showPageContent(string $slug): \Illuminate\Contracts\Support\Renderable
    {
        Assert::isInstanceOf($page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]), Page::class);
        // $page = Page::firstOrCreate(['slug' => $slug], ['content_blocks' => []]);
        $page = new \Modules\UI\View\Components\Render\Blocks(blocks: $page->content_blocks, model: $page);

        return $page->render();
    }
}
