{{-- 
    Icon Selector Component Usage Examples
    
    This file demonstrates how to use the icon-selector component in your Blade templates.
--}}

{{-- Example 1: Basic Usage --}}
<div class="example-1">
    <h3>Example 1: Basic Icon Selector</h3>
    
    <!-- Button to open icon selector -->
    <button onclick="IconSelector.open('basicIconModal')" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Select Icon
    </button>
    
    <!-- Display selected icon -->
    <div id="selectedIconDisplay" class="mt-4 p-4 border rounded">
        <p>Selected Icon: <span id="selectedIconName">None</span></p>
        <div id="selectedIconPreview" class="text-2xl mt-2"></div>
    </div>
    
    <!-- Include the icon selector component -->
    <x-icon-selector 
        modal-id="basicIconModal" 
        title="Choose Your Icon" 
        on-select-callback="handleBasicIconSelect" />
</div>

{{-- Example 2: Form Integration --}}
<div class="example-2 mt-8">
    <h3>Example 2: Form Integration</h3>
    
    <form>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Icon</label>
            <div class="flex items-center space-x-2">
                <input type="hidden" id="iconClassInput" name="icon_class" />
                <button type="button" 
                        onclick="IconSelector.open('formIconModal')" 
                        class="bg-gray-200 text-gray-700 px-3 py-2 rounded border hover:bg-gray-300">
                    <i id="formIconPreview" class="text-lg"></i>
                    <span id="formIconText">Choose Icon</span>
                </button>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" class="w-full px-3 py-2 border rounded" />
        </div>
        
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Save
        </button>
    </form>
    
    <!-- Include the icon selector component for form -->
    <x-icon-selector 
        modal-id="formIconModal" 
        title="Select Form Icon" 
        on-select-callback="handleFormIconSelect" />
</div>

{{-- Example 3: Multiple Icon Selectors --}}
<div class="example-3 mt-8">
    <h3>Example 3: Multiple Icon Selectors</h3>
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <h4>Primary Icon</h4>
            <button onclick="IconSelector.open('primaryIconModal')" 
                    class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                Select Primary Icon
            </button>
            <div id="primaryIconDisplay" class="mt-2 p-2 border rounded">
                <span id="primaryIconPreview" class="text-xl"></span>
                <span id="primaryIconName">None selected</span>
            </div>
        </div>
        
        <div>
            <h4>Secondary Icon</h4>
            <button onclick="IconSelector.open('secondaryIconModal')" 
                    class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                Select Secondary Icon
            </button>
            <div id="secondaryIconDisplay" class="mt-2 p-2 border rounded">
                <span id="secondaryIconPreview" class="text-xl"></span>
                <span id="secondaryIconName">None selected</span>
            </div>
        </div>
    </div>
    
    <!-- Include multiple icon selector components -->
    <x-icon-selector 
        modal-id="primaryIconModal" 
        title="Select Primary Icon" 
        on-select-callback="handlePrimaryIconSelect" />
        
    <x-icon-selector 
        modal-id="secondaryIconModal" 
        title="Select Secondary Icon" 
        on-select-callback="handleSecondaryIconSelect" />
</div>

@push('scripts')
<script>
// Example 1: Basic icon selection handler
function handleBasicIconSelect(iconClass, iconName, modalId) {
    document.getElementById('selectedIconName').textContent = iconName;
    document.getElementById('selectedIconPreview').innerHTML = `<i class="${iconClass}"></i>`;
}

// Example 2: Form integration handler
function handleFormIconSelect(iconClass, iconName, modalId) {
    document.getElementById('iconClassInput').value = iconClass;
    document.getElementById('formIconPreview').className = iconClass + ' text-lg';
    document.getElementById('formIconText').textContent = iconName;
}

// Example 3: Multiple icon selectors handlers
function handlePrimaryIconSelect(iconClass, iconName, modalId) {
    document.getElementById('primaryIconPreview').innerHTML = `<i class="${iconClass}"></i>`;
    document.getElementById('primaryIconName').textContent = iconName;
}

function handleSecondaryIconSelect(iconClass, iconName, modalId) {
    document.getElementById('secondaryIconPreview').innerHTML = `<i class="${iconClass}"></i>`;
    document.getElementById('secondaryIconName').textContent = iconName;
}

// Alternative: Using event listener instead of callback functions
document.addEventListener('iconSelected', function(event) {
    const { modalId, iconClass, iconName } = event.detail;
    
    // Handle different modals
    switch(modalId) {
        case 'basicIconModal':
            // Handle basic icon selection
            break;
        case 'formIconModal':
            // Handle form icon selection
            break;
        // Add more cases as needed
    }
});
</script>
@endpush

{{--
    Usage Instructions:
    
    1. Include the component in your Blade template:
       <x-icon-selector modal-id="yourModalId" title="Your Title" on-select-callback="yourCallback" />
    
    2. Create a button to open the modal:
       <button onclick="IconSelector.open('yourModalId')">Select Icon</button>
    
    3. Create a JavaScript callback function to handle icon selection:
       function yourCallback(iconClass, iconName, modalId) {
           // Handle the selected icon
           console.log('Selected:', iconClass, iconName);
       }
    
    4. Optional: Use event listener instead of callback:
       document.addEventListener('iconSelected', function(event) {
           const { modalId, iconClass, iconName } = event.detail;
           // Handle the selected icon
       });
    
    Component Props:
    - modal-id: Unique ID for the modal (required)
    - title: Modal title (optional, default: "Select an Icon")
    - on-select-callback: JavaScript function name to call when icon is selected (optional)
    
    JavaScript API:
    - IconSelector.open(modalId): Open the modal
    - IconSelector.close(modalId): Close the modal
    - IconSelector.select(modalId, iconClass, iconName, callback): Select an icon
    - IconSelector.filter(modalId): Filter icons (called automatically on search)
--}}