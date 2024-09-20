<x-app-layout>
    @if(session('success'))
        <div class="mx-[20%] mt-2 text-center bg-blue-200 text-lg font-bold text-green-500 rounded" id="success_msg">
            <h3>{{session('success')}}</h3>
        </div>
    @endif


</x-app-layout>
