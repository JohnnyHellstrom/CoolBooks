<x-layout>
    
    @php
        $categoryPrecisions = ['All', 'Per book', 'Per genre', 'Per author'];
        $categories = ['reviews', 'comments', 'replies'];
        $chartPrecisions = ['per day', 'per week'];    
    @endphp

    <div class="mb-6">
        <h2 class="text-3xl text-center font-bold my-6 uppercase">Statistics</h2>
        <hr>
    </div>

    <form action="/charts">
        <p class="text-gray-900 pl-1 mb-1">"Display (only review results are displayed if per book/per genre/per author is selected - date limitation still works)" </p>
        <div class="mb-4">
            <select name="categoryPrecision" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-1 mb-1 rounded">
                @foreach ($categoryPrecisions as $categoryPrecision)
                    <option value="{{$categoryPrecision}}">{{$categoryPrecision}}</option>
                    {{-- <option value="{{$categoryPrecision}}" {{ old('categoryPrecision') == $categoryPrecision ? 'selected' : '' }}>{{$categoryPrecision}}</option> --}}
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <select name="category" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-1 mb-1 rounded">
                @foreach ($categories as $category)
                    {{-- <option value="{{$category}}" {{ old('category') == $category ? 'selected' : '' }}>{{$category}}</option> --}}
                    <option value="{{$category}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <select name="chartPrecision" class="bg-gray-50 border border-gray-300 text-gray-900 block w-full p-1 mb-1 rounded">
                @foreach ($chartPrecisions as $chartPrecision)
                    <option value="{{$chartPrecision}}" {{ old('chartPrecision') == $chartPrecision ? 'selected' : '' }}>{{$chartPrecision}}</option>
                    {{-- <option value="{{$chartPrecision}}">{{$chartPrecision}}</option> --}}
                @endforeach    
            </select>    
        </div>

        <p class="text-gray-900 pl-1 mb-1">Includ information between...</p>
        {{-- Calendars --}}
        <div date-rangepicker class="mb-6 flex items-center">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-900 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-1.5 mb-1 rounded placeholder-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-grey-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
            </div>
            <span class="mx-4 text-gray-900">to</span>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-1.5 mb-1 rounded placeholder-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-grey-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
            </div>
        </div>

        <div class="mb-6">
            <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">Search</button>
        </div>
    </form>

    {{-- Display chart --}}
    <div>
        {!! $chart->container() !!}
    </div>

    {!! $chart->script() !!}

</x-layout>