<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        \App\Models\StudentRegistration::observe(\App\Observers\StudentRegistrationObserver::class);
        
        // Share explore categories with all views
        $this->shareExploreData();
    }
    
    /**
     * Share explore data with all views
     */
    protected function shareExploreData()
    {
        \Illuminate\Support\Facades\View::composer('partials.header', function ($view) {
            $exploreCategories = \Illuminate\Support\Facades\Cache::remember('header_explore_categories', 3600, function () {
                // Get all distinct categories from the database
                $dbCategories = \App\Models\Explore::where('status', 'published')
                    ->select('category')
                    ->distinct()
                    ->pluck('category')
                    ->toArray();
                
                // Map category keys to display labels
                $categoryLabels = [
                    'facility' => 'Facilities',
                    'extracurricular' => 'Extracurricular',
                    'islamic_life' => 'Islamic Life',
                    'school_life' => 'School Life'
                ];
                
                $exploreItems = [];
                foreach ($dbCategories as $category) {
                    // Use the mapped label if available, otherwise use title case of the category
                    $label = $categoryLabels[$category] ?? ucwords(str_replace('_', ' ', $category));
                    
                    $items = \App\Models\Explore::where('category', $category)
                        ->where('status', 'published')
                        ->orderBy('order')
                        ->get(['id', 'title', 'slug', 'category']);
                    
                    if ($items->count() > 0) {
                        $exploreItems[$category] = [
                            'label' => $label,
                            'items' => $items
                        ];
                    }
                }
                
                return $exploreItems;
            });
            
            $view->with('exploreCategories', $exploreCategories);
        });
    }
}
