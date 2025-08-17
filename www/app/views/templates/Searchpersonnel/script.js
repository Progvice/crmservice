var debounceTime = 1000;

$(".searchbar").on('change', function(e) {

    const earlierDebounceTime = window.debouncetimer;

    if (earlierDebounceTime >= Date.now() && (earlierDebounceTime - Date.now()) < 1000) {
        window.debounceTime = Date.now() + 1000;
        return;
    }

    const val = $(this).val();

    $.ajax({
        url: '/personel/read/q',
        method: 'POST',
        data: JSON.stringify({
            email: val
        }),
        contentType: 'application/json',
    }).done((res) => {
        console.log(res);
    });
});