function GetUrlQuery(){
    let url_string=location.href;
    let url=new URL(url_string);
    let st=url.searchParams.get("status");
    if(st=="ok"){
        swal({
            title: "Good job !",
            text: "You clicked the button!",
            icon: "success",
            button: "Aww yiss!",
          });
        setTimeout(Redirect,1500);
    }
    if(st=="no"){
        swal({
            title: "Sorry !",
            text: "You clicked the button!",
            icon: "error",
            button: "Aww yiss!",
          });
        setTimeout(Redirect,1500);
    }
    function Redirect(){
        location.href=location.protocol+"//"+location.host+location.pathname;
        console.log("jdd")
    }

}
GetUrlQuery();
function CurentPageName() {
    let path = location.pathname;
    let page = path.split("/").pop();
    return page;
}
function Delete(id,img){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            location.href=CurentPageName()+`?id=${id}&sil=ok&img=${img}`;
         
        } else {
          swal("Imtina edildi !!!");
        }
      });
}
function Redakte(id,i){
    let elmt=document.getElementsByClassName("Siyahi")[i].getElementsByTagName("td");
    let element2 = document.getElementsByClassName("Siyahi")[i].getElementsByTagName("input");
    let ksekill=element2[0].value;
    let ids=elmt[0].textContent;
    let ad=elmt[2].textContent;
    let vezife=elmt[3].textContent;
    let maas=elmt[4].textContent;
    let email=elmt[5].textContent;
    document.getElementById("ksekil").src = ksekill;
    document.getElementById("ksekil2").value = ksekill;
    document.getElementById("ad2").value=ad;
    document.getElementById("id2").value=ids;
    document.getElementById("vezife2").value=vezife;
    document.getElementById("maas2").value=maas;
    document.getElementById("email2").value=email;
  
  }
