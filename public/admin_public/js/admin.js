let uploadFile = function(id) {
    // console.log($(id)[0].files[0]);
    if ($(id).val() != '') {
        let file = $(id)[0].files[0];
        let reader = new FileReader();

        reader.onload = function () {
            $(id).attr('value', this.result);
            $(id + '-image').attr('src', this.result);
        };
        reader.readAsDataURL(file);
    }
}

let date_input_format = function(unformatted_date) {
    const date = new Date(unformatted_date);
    let result = `${date.getFullYear()}-${("0" + (date.getMonth() + 1)).slice(-2)}-${("0" + date.getDate()).slice(-2)}`;
    return result;
}

let date_base_format = function(unformatted_date) {
    const date = new Date(unformatted_date);
    const days = ['Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agutus', 'September', 'Oktober', 'November', 'Desember'];
    let result = `${days[date.getDay()]}, ${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()} `;
    return result;
}


function clear_input_fields() {
    $('input').val('');
    $('textarea').val('');
    $('.selectpicker').selectpicker('val', '');
    $('.selectpicker').selectpicker('render');
}