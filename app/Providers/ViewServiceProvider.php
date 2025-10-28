<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Explore;

/**
 * ViewServiceProvider - 为视图提供全局共享数据
 * 
 * 这个服务提供者负责为所有视图提供通用的数据，如导航菜单数据。
 * 使用缓存机制来优化性能，避免在每个请求中重复查询数据库。
 */
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * 
     * 为所有视图共享explore导航数据，使用缓存优化性能
     */
    public function boot(): void
    {
        // 为所有视图共享explore导航数据
        // 架构决策：将导航数据查询从视图层迁移到服务层，遵循MVC最佳实践
        View::composer('*', function ($view) {
            // 使用缓存机制优化性能，缓存时间为5分钟
            $exploreNavigation = Cache::remember('explore_navigation', 300, function () {
                try {
                    // 获取所有已发布的explore分类，用于导航菜单
                    $categories = Explore::select('category', 'title', 'slug')
                        ->where('status', 'published')
                        ->orderBy('order')
                        ->get()
                        ->groupBy('category')
                        ->map(function ($items) {
                            // 每个分类取第一个项目作为代表
                            return $items->first();
                        });
                    
                    return $categories;
                } catch (\Throwable $e) {
                    \Log::warning('Failed to load explore navigation data: ' . $e->getMessage());
                    return collect();
                }
            });
            
            // 将数据共享给所有视图
            $view->with('exploreNavigation', $exploreNavigation);
        });
    }
}