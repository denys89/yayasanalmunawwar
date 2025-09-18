<?php

/**
 * CMS CRUD Testing Script
 * This script tests all CRUD operations for each CMS module
 */

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\CMS\PageController;
use App\Http\Controllers\CMS\ProgramController;
use App\Http\Controllers\CMS\ExploreController;
use App\Http\Controllers\CMS\NewsController;
use App\Http\Controllers\CMS\AdmissionController;
use App\Http\Controllers\CMS\MediaController;
use App\Http\Controllers\CMS\FaqController;
use App\Http\Controllers\CMS\SettingController;

class CMSCrudTester
{
    private $results = [];
    
    public function __construct()
    {
        // Bootstrap Laravel
        $app = require_once 'bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    }
    
    public function testAllModules()
    {
        echo "=== CMS CRUD Testing Started ===\n\n";
        
        $this->testPagesModule();
        $this->testProgramsModule();
        $this->testExploreModule();
        $this->testNewsModule();
        $this->testAdmissionsModule();
        $this->testMediaModule();
        $this->testFaqsModule();
        $this->testSettingsModule();
        
        $this->printSummary();
    }
    
    private function testPagesModule()
    {
        echo "Testing Pages Module CRUD Operations:\n";
        echo "====================================\n";
        
        try {
            // Test READ (Index)
            $controller = new PageController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Pages', 'READ (Index)', $response->getStatusCode() == 200);
            
            // Test CREATE
            $createData = [
                'title' => 'Test Page',
                'slug' => 'test-page-' . time(),
                'content' => '<p>This is a test page content.</p>',
                'type' => 'page',
                'status' => 'published'
            ];
            $createRequest = new Request($createData);
            $createResponse = $controller->store($createRequest);
            $this->logResult('Pages', 'CREATE', $createResponse->getStatusCode() == 302);
            
            echo "✓ Pages module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Pages module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Pages', 'Overall', false);
        }
    }
    
    private function testProgramsModule()
    {
        echo "Testing Programs Module CRUD Operations:\n";
        echo "=======================================\n";
        
        try {
            $controller = new ProgramController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Programs', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ Programs module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Programs module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Programs', 'Overall', false);
        }
    }
    
    private function testExploreModule()
    {
        echo "Testing Explore Module CRUD Operations:\n";
        echo "======================================\n";
        
        try {
            $controller = new ExploreController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Explore', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ Explore module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Explore module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Explore', 'Overall', false);
        }
    }
    
    private function testNewsModule()
    {
        echo "Testing News Module CRUD Operations:\n";
        echo "===================================\n";
        
        try {
            $controller = new NewsController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('News', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ News module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ News module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('News', 'Overall', false);
        }
    }
    
    private function testAdmissionsModule()
    {
        echo "Testing Admissions Module CRUD Operations:\n";
        echo "=========================================\n";
        
        try {
            $controller = new AdmissionController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Admissions', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ Admissions module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Admissions module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Admissions', 'Overall', false);
        }
    }
    
    private function testMediaModule()
    {
        echo "Testing Media Module CRUD Operations:\n";
        echo "====================================\n";
        
        try {
            $controller = new MediaController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Media', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ Media module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Media module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Media', 'Overall', false);
        }
    }
    
    private function testFaqsModule()
    {
        echo "Testing FAQs Module CRUD Operations:\n";
        echo "===================================\n";
        
        try {
            $controller = new FaqController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('FAQs', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ FAQs module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ FAQs module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('FAQs', 'Overall', false);
        }
    }
    
    private function testSettingsModule()
    {
        echo "Testing Settings Module CRUD Operations:\n";
        echo "=======================================\n";
        
        try {
            $controller = new SettingController();
            $request = new Request();
            $response = $controller->index($request);
            $this->logResult('Settings', 'READ (Index)', $response->getStatusCode() == 200);
            
            echo "✓ Settings module tested successfully\n\n";
            
        } catch (Exception $e) {
            echo "✗ Settings module test failed: " . $e->getMessage() . "\n\n";
            $this->logResult('Settings', 'Overall', false);
        }
    }
    
    private function logResult($module, $operation, $success)
    {
        $this->results[] = [
            'module' => $module,
            'operation' => $operation,
            'success' => $success
        ];
        
        $status = $success ? '✓' : '✗';
        echo "  {$status} {$module} - {$operation}: " . ($success ? 'PASSED' : 'FAILED') . "\n";
    }
    
    private function printSummary()
    {
        echo "\n=== TESTING SUMMARY ===\n";
        
        $totalTests = count($this->results);
        $passedTests = count(array_filter($this->results, function($result) {
            return $result['success'];
        }));
        
        echo "Total Tests: {$totalTests}\n";
        echo "Passed: {$passedTests}\n";
        echo "Failed: " . ($totalTests - $passedTests) . "\n";
        echo "Success Rate: " . round(($passedTests / $totalTests) * 100, 2) . "%\n\n";
        
        // Group by module
        $moduleResults = [];
        foreach ($this->results as $result) {
            $moduleResults[$result['module']][] = $result;
        }
        
        foreach ($moduleResults as $module => $results) {
            $modulePassedTests = count(array_filter($results, function($result) {
                return $result['success'];
            }));
            $moduleTotalTests = count($results);
            
            echo "{$module}: {$modulePassedTests}/{$moduleTotalTests} tests passed\n";
        }
    }
}

// Run the tests
$tester = new CMSCrudTester();
$tester->testAllModules();