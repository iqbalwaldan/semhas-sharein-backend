<!-- Modal Alert -->
{{ $slot }}
<div id={{ $id }}
    class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-sm">
        <div class="flex flex-col p-5 items-center">
            <img src={{ $img }} alt="" class="w-16">
            <h2 class="text-xl font-medium mt-5">{{ $title }}</h2>
            <p class="text-md font-light mb-5 text-center">{{ $message }}</p>
            <div class="flex flex-row w-full gap-3 justify-center">
                <button id={{ $cancel }} type="button"
                    class="w-full py-2 text-sm font-medium text-center text-primary-base bg-primary-10 rounded-lg">
                    Cancel
                </button>
                <button id={{ $agree }} type="button"
                    class="w-full py-2 text-sm font-medium text-center text-white bg-primary-base rounded-lg w-full">
                    {{ $agreeText }}
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Alert -->
