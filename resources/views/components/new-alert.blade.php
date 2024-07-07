<!-- Modal Alert -->
@props(['name' => 'Test'])
{{ $slot }}
<div id="alert-confirm"
    class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-sm">
        <div class="flex flex-col p-5 items-center">
            <img src="/assets/icons/alert-circle-warning.png" alt="" class="w-16">
            <h2 class="text-xl font-medium mt-5">{{ $titleConfirm }}</h2>
            <p class="text-md font-light mb-5 text-center">{{ $messageConfirm }}</p>
            <div class="flex flex-row w-full gap-3 justify-center">
                <button id="button-cancel" type="button"
                    class="w-full py-2 text-sm font-medium text-center text-primary-base bg-primary-10 rounded-lg">
                    Cancel
                </button>
                <button id="button-agree" type="button"
                    class="w-full py-2 text-sm font-medium text-center text-white bg-primary-base rounded-lg w-full">
                    {{ $agreeText }}
                </button>
            </div>
        </div>
    </div>
</div>
<div id="alert-success"
    class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-sm">
        <div class="flex flex-col p-5 items-center">
            <img src="/assets/icons/alert-circle-success.png" alt="" class="w-16">
            <h2 class="text-xl font-medium mt-5">{{ $titleSuccess }}</h2>
            <p class="text-md font-light mb-5 text-center">{{ $messageSuccess }}</p>
            <div class="flex flex-row w-full gap-3 justify-center">
                <button id="button-succcess" type="button"
                    class="w-full py-2 text-sm font-medium text-center text-white bg-primary-base rounded-lg w-full">
                    Okey
                </button>
            </div>
        </div>
    </div>
</div>
<div id="alert-failed"
    class="fixed inset-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden overflow-y-auto">
    <div class="bg-white rounded-lg max-h-screen overflow-y-auto w-full max-w-sm">
        <div class="flex flex-col p-5 items-center">
            <img src="/assets/icons/alert-circle-danger.png" alt="" class="w-16">
            <h2 class="text-xl font-medium mt-5">{{ $titleFailed }}</h2>
            <p class="text-md font-light mb-5 text-center">{{ $messageFailed }}</p>
            <div class="flex flex-row w-full gap-3 justify-center">
                <button id="button-failed" type="button"
                    class="w-full py-2 text-sm font-medium text-center text-white bg-primary-base rounded-lg w-full">
                    Okey
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const alertConfirm = document.getElementById('alert-confirm');
    const alertSuccess = document.getElementById('alert-success');
    const alertFailed = document.getElementById('alert-failed');
    const buttonCancel = document.getElementById('button-cancel');
    const buttonAgree = document.getElementById('button-agree');
    const buttonSuccess = document.getElementById('button-success');
    const buttonFailed = document.getElementById('button-failed');


    buttonCancel.addEventListener('click', () => {
        alertConfirm.classList.add('hidden');
    });

    buttonAgree.addEventListener('click', () => {
        alertConfirm.classList.add('hidden');
        alertSuccess.classList.remove('hidden');
    });

    buttonSuccess.addEventListener('click', () => {
        alertSuccess.classList.add('hidden');
    });

    buttonFailed.addEventListener('click', () => {
        alertFailed.classList.add('hidden');
    });
</script>
<!-- End Modal Alert -->
