<x-page :page-headings='$pageHeadings'>
     <div class="flex !border-t border-t-gray-200">
        <div class="w-1/4 list-menu h-fit relative bg-transparent">
            <ul>
                <li class="!border-b !border-b-gray-200">
                    <a href="/dashboard/sandbox/text">
                        Text
                    </a>
                </li>
                <li class="!border-b !border-b-gray-100">
                    <a href="/dashboard/sandbox/buttons">
                        Buttons
                    </a>
                </li>
                <li class="!border-b !border-b-gray-100">
                    <a href="/dashboard/sandbox/alerts">
                        Alerts
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="w-3/4 p-6 border-l border-l-gray-200 mt-6 ml-6">
            {{$slot}}
        </div>
    </div>
</x-page>