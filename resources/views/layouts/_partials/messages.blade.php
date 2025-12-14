@if ($message = Session::get('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 flex items-center" role="alert">
    <i class="fa-solid fa-circle-check mr-3"></i>
    <span class="flex-1">{{ $message }}</span>
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:bg-green-200 rounded-r transition-colors" onclick="this.parentElement.remove()" aria-label="Close">
        <i class="fa-solid fa-xmark text-green-500 text-xl"></i>
    </button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4 flex items-center" role="alert">
    <i class="fa-solid fa-triangle-exclamation mr-3"></i>
    <span class="flex-1">{{ $message }}</span>
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:bg-yellow-200 rounded-r transition-colors" onclick="this.parentElement.remove()" aria-label="Close">
        <i class="fa-solid fa-xmark text-yellow-500 text-xl"></i>
    </button>
</div>
@endif

@if ($message = Session::get('danger'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 flex items-center" role="alert">
    <i class="fa-solid fa-trash mr-3"></i>
    <span class="flex-1">{{ $message }}</span>
    <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3 hover:bg-red-200 rounded-r transition-colors" onclick="this.parentElement.remove()" aria-label="Close">
        <i class="fa-solid fa-xmark text-red-500 text-xl"></i>
    </button>
</div>
@endif