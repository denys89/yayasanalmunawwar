@props([
    'modalId' => 'iconSelectorModal',
    'modalType' => 'default',
    'title' => 'Select an Icon'
])

@php
    use App\Helpers\IconHelper;
    $iconCategories = IconHelper::getIconCategories();
@endphp

<div id="{{ $modalId }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full mx-4 max-h-[90vh] flex flex-col">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b flex-shrink-0">
            <h3 class="text-xl font-semibold text-gray-800">{{ $title }}</h3>
            <button onclick="closeIconSelector('{{ $modalType }}')" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6 overflow-y-auto flex-1 min-h-0">
            <!-- Search Input -->
            <div class="mb-6">
                <input type="text" 
                       id="{{ $modalType }}-icon-search" 
                       placeholder="Search icons..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                       onkeyup="filterIconGrid('{{ $modalType }}')">
            </div>
            
            <!-- Icon Grid -->
            <div id="{{ $modalType }}-icon-grid" class="space-y-8">
                @foreach($iconCategories as $categoryKey => $category)
                    <div class="icon-category">
                        <!-- Category Header -->
                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="{{ $category['icon'] }} {{ 'text-' . $category['color'] . '-600' }} mr-2"></i>
                            {{ $category['title'] }}
                        </h4>
                        
                        <!-- Category Icons Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3 md:gap-4">
                            @foreach($category['icons'] as $icon)
                                @php
                                    $colorClasses = IconHelper::getColorClasses($category['color']);
                                @endphp
                                <div class="icon-option group border-2 border-gray-200 rounded-xl p-4 text-center cursor-pointer hover:{{ $colorClasses['border'] }} hover:{{ $colorClasses['bg'] }} transition-all duration-300 transform hover:scale-105" 
                                     data-icon="{{ $icon['class'] }}" 
                                     data-name="{{ $icon['name'] }}" 
                                     onclick="selectIcon('{{ $modalType }}', '{{ $icon['class'] }}', '{{ $icon['name'] }}')">
                                    <i class="{{ $icon['class'] }} text-3xl mb-2 text-gray-600 group-hover:{{ $colorClasses['text'] }} transition-colors"></i>
                                    <p class="text-xs font-medium text-gray-700">{{ $icon['name'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Icon selector functionality
    function openIconSelector(modalType) {
        const modalId = modalType === 'add-value' ? 'addValueIconSelectorModal' : 
                       modalType === 'edit-value' ? 'editValueIconSelectorModal' : 
                       '{{ $modalId }}';
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeIconSelector(modalType) {
        const modalId = modalType === 'add-value' ? 'addValueIconSelectorModal' : 
                       modalType === 'edit-value' ? 'editValueIconSelectorModal' : 
                       '{{ $modalId }}';
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function selectIcon(modalType, iconClass, iconName) {
        // Dispatch custom event with icon data
        const event = new CustomEvent('iconSelected', {
            detail: {
                modalType: modalType,
                iconClass: iconClass,
                iconName: iconName
            }
        });
        document.dispatchEvent(event);
        
        // Close the modal
        closeIconSelector(modalType);
    }

    function filterIconGrid(modalType) {
        const searchInput = document.getElementById(modalType + '-icon-search');
        const iconGrid = document.getElementById(modalType + '-icon-grid');
        const searchTerm = searchInput.value.toLowerCase();
        
        const iconOptions = iconGrid.querySelectorAll('.icon-option');
        const categories = iconGrid.querySelectorAll('.icon-category');
        
        iconOptions.forEach(option => {
            const iconName = option.getAttribute('data-name').toLowerCase();
            const iconClass = option.getAttribute('data-icon').toLowerCase();
            
            if (iconName.includes(searchTerm) || iconClass.includes(searchTerm)) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
        
        // Hide categories that have no visible icons
        categories.forEach(category => {
            const visibleIcons = category.querySelectorAll('.icon-option[style="display: block"], .icon-option:not([style*="display: none"])');
            if (visibleIcons.length === 0 && searchTerm !== '') {
                category.style.display = 'none';
            } else {
                category.style.display = 'block';
            }
        });
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            const modalType = event.target.id.includes('add') ? 'add-value' : 
                             event.target.id.includes('edit') ? 'edit-value' : 'default';
            closeIconSelector(modalType);
        }
    });
</script>
@endpush