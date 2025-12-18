<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
            <ul role="list" class="-mx-2 space-y-1">
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">WEBSITE</div>
                </li>
                <li>
                    <a href="{{ route('cms.homepage.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.homepage*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.homepage*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4.5 9.75V21h15V9.75" />
                        </svg>
                        Homepage
                    </a>
                </li>
                <li>
                    <a href="{{ Auth::user()->role === 'editor' ? route('cms.banners.editor.index') : route('cms.banners.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.banners*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.banners*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5h16.5A1.5 1.5 0 0121.75 6v12a1.5 1.5 0 01-1.5 1.5H3.75A1.5 1.5 0 012.25 18V6A1.5 1.5 0 013.75 4.5zm4.5 3h7.5v6h-7.5V7.5zm0 7.5h4.5v3h-4.5v-3z" />
                        </svg>
                        Banners
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.pages.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.pages*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.pages*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        Pages
                    </a>
                </li>
                
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">ABOUT</div>
                </li>
                <li>
                    <a href="{{ route('cms.history.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.history*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.history*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75V3m0 3.75c-4.556 0-8.25 3.694-8.25 8.25S7.444 23.25 12 23.25s8.25-3.694 8.25-8.25S16.556 6.75 12 6.75zm.75 4.5a.75.75 0 00-1.5 0v4.5a.75.75 0 00.75.75h3a.75.75 0 000-1.5h-2.25V11.25z" />
                        </svg>
                        History
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.vision_mission.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.vision_mission*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.vision_mission*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75V3m0 3.75c-4.556 0-8.25 3.694-8.25 8.25S7.444 23.25 12 23.25s8.25-3.694 8.25-8.25S16.556 6.75 12 6.75m-3 3.75h6m-6 3h6" />
                        </svg>
                        Vision & Mission
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.organizational_structure.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.organizational_structure*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.organizational_structure*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h15a1.5 1.5 0 011.5 1.5v7.5a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5zm3 3h9v5.25h-9V9.75z" />
                        </svg>
                        Organizational Structure
                    </a>
                </li>
                
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">PROGRAMS & CONTENT</div>
                </li>
                <li>
                    <a href="{{ route('cms.programs.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.programs*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.programs*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        Programs
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.explores.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.explores*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.explores*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        Explores
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.news.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.news*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.news*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                        </svg>
                        News
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.events.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.events*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.events*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 8.25h18M4.5 21h15a2.25 2.25 0 002.25-2.25V8.25A2.25 2.25 0 0019.5 6H4.5A2.25 2.25 0 002.25 8.25v10.5A2.25 2.25 0 004.5 21zm3-9h3v3h-3v-3z" />
                        </svg>
                        Events
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.media.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.media*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.media*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        Media
                    </a>
                </li>
                
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">ADMISSIONS</div>
                </li>
                <li>
                    <a href="{{ route('cms.admission-waves.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.admission-waves*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.admission-waves*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5a2.25 2.25 0 012.25 2.25v7.5M9 12.75h6m-6 3h6" />
                        </svg>
                        Admission Waves
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.student-registrations.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.student-registrations*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.student-registrations*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        Student Registrations
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.students.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.students*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.students*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                        </svg>
                        Students
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.discounts.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.discounts*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.discounts*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                        Discounts
                    </a>
                </li>
                
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">SUPPORT</div>
                </li>
                <li>
                   <a href="{{ route('cms.faqs.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.faqs*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                       <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.faqs*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                       </svg>
                       FAQs
                   </a>
               </li>
                <li>
                    <a href="{{ route('cms.contact-us.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.contact-us*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.contact-us*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.32 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        Contact Us
                    </a>
                </li>
                @endif
                
                @if(Auth::user()->role === 'admin')
                <li>
                    <div class="text-xs font-semibold leading-6 text-gray-400 dark:text-gray-500 mt-6 mb-2">ADMINISTRATION</div>
                </li>
                <li>
                    <a href="{{ route('cms.users.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.users*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.users*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('cms.settings.index') }}" class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold {{ request()->routeIs('cms.settings*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/50 dark:text-blue-200' : 'text-gray-700 hover:text-blue-700 hover:bg-blue-50 dark:text-gray-300 dark:hover:text-blue-200 dark:hover:bg-blue-900/50' }}">
                        <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('cms.settings*') ? 'text-blue-700 dark:text-blue-200' : 'text-gray-400 group-hover:text-blue-700 dark:group-hover:text-blue-200' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a>
                </li>
                @endif
            </ul>
        </li>
        
        <li class="mt-auto">
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-700 hover:text-red-700 hover:bg-red-50 dark:text-gray-300 dark:hover:text-red-200 dark:hover:bg-red-900/50">
                        <svg class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-red-700 dark:group-hover:text-red-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>