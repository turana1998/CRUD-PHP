<?php
ob_start();
 require_once "./app/controller.php";
 require_once "./app/worker.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./img/icon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Crud Operation</title>
</head>

<body>

    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <button data-bs-toggle="modal" data-bs-target="#add" type="button" class="btn btn-success tex-end">Əlavə
                Et:</button>
             <div class="d-flex">
             <select class="form-control w-auto me-3" id="options">
                            <option value="adsoyad">Ad Soyad</option>
                            <option value="vezife">Vezife</option>
                            <option value="maas">Maas</option>
                            <option value="email">Email</option>
              </select>
            <input onkeyup="showResult(this.value)" class="form-control me-2 w-auto" type="search" placeholder="Search"
                aria-label="Search">
             </div>
        </div>
        <div id="livesearch"></div>
        <hr>
        <table class="table table-success  table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Şəkil</th>
                    <th scope="col">Ad Soyad</th>
                    <th scope="col">Vəzifə</th>
                    <th scope="col">Maaş</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ailə.v</th>
                    <th scope="col">Əməliyyatlar</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<count($siyahi);$i++){ ?>
                <tr class="Siyahi">
                    <td><?=$siyahi[$i]["id"]?></td>
                    <td scope="row">
                        <img id="sekill" height="40px" src="./<?=$siyahi[$i]["img"]?>" />
                    </td>
                    <input type="hidden" id="ksekill" value="./<?=$siyahi[$i]["img"]?>">
                    <td><?=$siyahi[$i]["adsoyad"]?></td>
                    <td><?=$siyahi[$i]["vezife"]?></td>
                    <td><?=$siyahi[$i]["maas"]?></td>
                    <td><?=$siyahi[$i]["email"]?></td>
                    <td>

                        <select onchange="changeStatus(<?=$siyahi[$i]['id']?>,this.value)" class="form-control"
                            id="inputGroupSelect01">
                            <option <?=$siyahi[$i]["av"]=='0' ? 'selected' : ""?> value="0">Evli</option>
                            <option <?=$siyahi[$i]["av"]=='1' ? 'selected' : ""?> value="1">Subay</option>
                        </select>
                    </td>
                    <td>
                        <button onclick="Redakte(<?=$siyahi[$i]['id']?>,<?= $i?> )" data-bs-toggle="modal"
                            data-bs-target="#redakte" type="button" class="btn btn-success">Redaktə</button>
                        <button onclick="Delete(<?=$siyahi[$i]['id']?>,'<?=$siyahi[$i]['img']?>')" type="button"
                            class="btn btn-danger">Sil</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Əlavə Et </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="mt-3">
                            <h2 class="text-center m-3 ">İşçi əlavə etmə</h2>
                            <form enctype="multipart/form-data" action="#" method="POST">
                                <div class="mb-3">
                                    <label for="ad" class="form-label">Ad Soyad</label>
                                    <input name="ad" type="text" class="form-control" id="ad" aria-describedby="ad">
                                </div>
                                <div class="mb-3">
                                    <label for="vezife" class="form-label">Vəzifə</label>
                                    <input name="vezife" type="text" class="form-control" id="vezife"
                                        aria-describedby="vezife">
                                </div>
                                <div class="mb-3">
                                    <label for="maas" class="form-label">Maaş</label>
                                    <input name="maas" type="text" class="form-control" id="maas"
                                        aria-describedby="maas">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email"
                                        aria-describedby="email">
                                </div>

                                <div class="mb-3">
                                    <label for="select" class="form-label">Ailə vəziyyəti</label>
                                    <br>
                                    <input type="radio" id="evli" name="av" value="1">
                                    <label for="evli">Evli</label><br>
                                    <input type="radio" id="subay" name="av" value="0">
                                    <label for="subay">Subay</label><br>
                                </div>
                                <div class="mb-3">
                                    <label for="sekil" class="form-label">Şəkil</label>
                                    <input name="sekil" type="file" class="form-control" id="sekil"
                                        aria-describedby="sekil">
                                </div>
                                <button name="send" type="submit" class="btn btn-success">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="redakte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Redaktə Et I</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" action="#" method="POST">
                        <input type="hidden" id="ksekil2" name="ksekil">
                        <input type="hidden" id="id2" name="id">
                        <div class="mb-3">
                            <img height="100px" id="ksekil" src="" />
                        </div>
                        <div class="mb-3">
                            <label for="ad" class="form-label">Ad Soyad</label>
                            <input name="ad" type="text" class="form-control" id="ad2" aria-describedby="ad">
                        </div>
                        <div class="mb-3">
                            <label for="vezife" class="form-label">Vəzifə</label>
                            <input name="vezife" type="text" class="form-control" id="vezife2"
                                aria-describedby="vezife">
                        </div>
                        <div class="mb-3">
                            <label for="maas" class="form-label">Maaş</label>
                            <input name="maas" type="text" class="form-control" id="maas2" aria-describedby="maas">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email2" aria-describedby="email">
                        </div>
                        <div class="mb-3">
                            <label for="sekil" class="form-label">Şəkil</label>
                            <input name="sekil" type="file" class="form-control" id="sekil2" aria-describedby="sekil">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                            <button name="redakte" type="submit" class="btn btn-success">Yadda saxla</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="./dist/functions.js"></script>
    <script>
    const changeStatus = (id, value) => {
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "./app/ajax.php");
        xhttp.onload = function() {
            const data = this.responseText;
            if (data) {
                swal({
                    title: "Good job !",
                    text: "You clicked the button!",
                    icon: "success",
                });
            } else {
                swal({
                    title: "Error!",
                    text: "Nc NC!",
                    icon: "error",
                });
            }
        };
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`id=${id}&value=${value}&change=ok`);
    };

    function showResult(str) {
        let option=document.getElementById("options").value;
        console.log(option);
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "./app/ajax.php");
        xhttp.onload = function() {
            const data = this.responseText;
            if (data) {
                console.log(data);
                document.getElementById("livesearch").innerHTML = this.responseText;
            }
        };
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`option=${option}&str=${str}&search=ok`);
    }
    </script>
</body>

</html>