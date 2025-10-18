<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Explore;
use Illuminate\Support\Facades\DB;

class ExploreController extends Controller
{
    /**
     * Display explore page by slug
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get all unique categories from the database
        $categories = Explore::select('category')
            ->where('status', 'published')
            ->distinct()
            ->pluck('category')
            ->toArray();
            
        // Generate dynamic category map based on database entries
        $categoryMap = [];
        // Also create a reverse map from category to standardized slug
        $categoryToSlugMap = [];
        
        foreach ($categories as $category) {
            // Get the first explore item in this category to use its slug as the category slug
            $firstItem = Explore::where('category', $category)
                ->where('status', 'published')
                ->orderBy('order')
                ->first();
                
            if ($firstItem) {
                // Convert category to URL-friendly format
                $urlSlug = str_replace('_', '-', $category);
                $categoryMap[$urlSlug] = $category;
                $categoryToSlugMap[$category] = $urlSlug;
            }
        }
        
        // Check if this is a category slug
        if (isset($categoryMap[$slug])) {
            $category = $categoryMap[$slug];
            
            // Get all explores with this category
            $explores = Explore::where('category', $category)
                ->where('status', 'published')
                ->orderBy('order')
                ->get();
                
            // Get the first explore as the main one (if available)
            $explore = $explores->first();
            
            // Use the title from the first explore item in this category
            $title = $explore ? $explore->title : ucfirst(str_replace('_', ' ', $category));
            
            return view('explore.show', [
                'explore' => $explore,
                'explores' => $explores,
                'title' => $title,
                'category' => $category,
                'categoryToSlugMap' => $categoryToSlugMap
            ]);
        }
        
        // Regular explore item by slug
        $explore = Explore::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();
            
        // Get all explores with the same category
        $explores = Explore::where('category', $explore->category)
            ->where('status', 'published')
            ->orderBy('order')
            ->get();
        
        // Use the title from the explore item
        $title = $explore->title;
        
        return view('explore.show', [
            'explore' => $explore,
            'explores' => $explores,
            'title' => $title,
            'category' => $explore->category,
            'categoryToSlugMap' => $categoryToSlugMap
        ]);
    }
}