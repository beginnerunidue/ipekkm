function init() {
    $.post(
        "core.php",
        {
            "action": "init"
        },
        showGoods
    );
}

function showGoods(data) {
    console.log(data);
    data = JSON.parse(data); // parse JSON in object
    console.log(data);
    let out = '<select>';
    out += '<option data-id="0">Neuer Artikel</option >';
    for (let id in data) {
        out += `<option data-id="${id}">${data[id].name}</option>`;
    }
    out += '</select>';
    $('.goods-out').html(out);
    $('.goods-out select').on('change', selectGoods);
    $('.add-to-db').on('click', saveToDb);
}

function selectGoods() {
    // console.log('selectGoods works');
    let id = $('.goods-out select option:selected').attr('data-id');
    console.log(id);
    $.post(
        "core.php",
        {
            "action": "selectOneOfGoods",
            "gid": id
        },
        function (data) {
            // console.log(data);
            data = JSON.parse(data);
            console.log(data);
            $('#gname').val(data.name);
            $('#gcost').val(data.cost);
            $('#gdescription').val(data.description);
            $('#gorder').val(data.ordertb);
            $('#gimage').val(data.img);
            $('#gid').val(data.id);
        }
    );
}

function saveToDb() {
    let id = $('#gid').val();
    if (id != undefined) { // existierende in db Artikel
        $.post(
            "core.php",
            {
                "action": "updateGoods",
                "gid": id,
                "gname": $('#gname').val(),
                "gcost": $('#gcost').val(),
                "gdescription": $('#gdescription').val(),
                "gorder": $('#gorder').val(),
                "gimage": $('#gimage').val()
            },
            function (data) {
                console.log(data);
                if (data == "Record updated successfully") {
                    init();
                    alert('Update erfolgreich');
                } else {
                    console.log(data);
                }
            }
        )
    }
}

$(document).ready(function () {
    init();
    $('add-to-db').on('click', saveToDb);
});