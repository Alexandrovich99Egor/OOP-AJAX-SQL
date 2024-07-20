window.addEventListener("load", function () {
  //take data from input
  function getDataClient() {
    //var to sends
    let btn = document.getElementById("btn-send");
    let inpName = document.getElementById("inp-name");
    let inpPass = document.getElementById("inp-pass");

    btn.addEventListener("click", () => {
      let name = inpName.value;
      let pass = inpPass.value;

      if (name !== "" && pass !== "") {
        sendData(name, pass);;
      }
    });
  }
  getDataClient();

  //send value to server
  function sendData(name, pass) {
    let xhr = new XMLHttpRequest();

    try {
      xhr.open("POST", "http://localhost:8888/testing/back/users.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            console.log(xhr.responseText);
          } else {
            console.error("Error: " + xhr.status);
          }
        }
      };

      xhr.send(`name=${name}&pass=${pass}`);
    } catch {
      console.log(xhr.onerror);
    }
  }
});
