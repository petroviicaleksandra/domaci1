$('#dodajForm').submit(function(){
    event.preventDefault();
    console.log("Dodavanje");
    const $form =$(this);
    const $input = $form.find('input, select, button, textarea');

    const serijalizacija = $form.serialize();
    console.log(serijalizacija);

    $input.prop('disabled', true);

    req = $.ajax({
        url: 'kontroler/add.php',
        type:'post',
        data: serijalizacija
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
            alert("Karta kupljena");
            console.log("Dodata karta");
            location.reload(true);
        }else console.log("Karta nije kupljena "+res);
        console.log(res);
    });

    req.fail(function(jqXHR, textStatus, errorThrown){
        console.error('Greska: '+textStatus, errorThrown)
    });
});

$('#btn-obrisi').click(function(){
    console.log("Brisanje");

    const checked = $('input[name=checked-donut]:checked');

    req = $.ajax({
        url: 'kontroler/delete.php',
        type:'post',
        data: {'brojKarte':checked.val()}
    });

    req.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
           checked.closest('tr').remove();
           alert('Obrisana karta');
           console.log('Obrisana');
        }else {
        console.log("Karta nije obrisana "+res);
        alert("Karta nije obrisana ");

        }
        console.log(res);
    });

});

$('#btn-izmeni').click(function () {
    const checked = $('input[name=checked-donut]:checked');
    req = $.ajax({
        url: 'kontroler/get.php',
        type: 'post',
        data: {'brojKarte': checked.val()},
        dataType: 'json'
    });


    req.done(function (response, textStatus, jqXHR) {
        console.log('Popunjena');
        $('#user').val(response[0]['UserId']);
        console.log(response[0]['UserId']);

        $('#film').val(response[0]['filmId'].trim());
        console.log(response[0]['filmId'].trim());

        $('#email').val(response[0]['email'].trim());
        console.log(response[0]['email'].trim());

       
        $('#brojKarte').val(checked.val());

        console.log(response);
    });

   req.fail(function (jqXHR, textStatus, errorThrown) {
       console.error('Greska: ' + textStatus, errorThrown);
   });

});

$('#izmeniForm').submit(function () {
    event.preventDefault();
    console.log("Izmene");
    const $form = $(this);
    const $inputs = $form.find('input, select, button, textarea');
    const serialized = $form.serialize();
    console.log(serialized);
    $inputs.prop('disabled', true);

    req = $.ajax({
        url: 'kontroler/update.php',
        type: 'post',
        data: serialized
    });
    req.done(function (response, textStatus, jqXHR) {


        if (response === 'Success') {
            console.log('Karta je izmenjena');
            location.reload(true);
        }
        else console.log('Karta nije izmenjena ' + response);
        console.log(response);
    });

    req.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska: ' + textStatus, errorThrown);
    });


});

$('#btn-pretraga').click(function () {

    var para = document.querySelector('#myInput');
    console.log(para);
    var style = window.getComputedStyle(para);
    console.log(style);
    if (!(style.display === 'inline-block') || ($('#myInput').css("visibility") ==  "hidden")) {
        console.log('block');
        $('#myInput').show();
        document.querySelector("#myInput").style.visibility = "";
    } else {
       document.querySelector("#myInput").style.visibility = "hidden";
    }
});

$('#btn').click(function () {
    $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});

$('#btnIzmeni').submit(function () {
    $('#myModal').modal('toggle');
    return false;
});


    