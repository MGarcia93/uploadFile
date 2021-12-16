


const writeMessage = (message, type) => {

    const alert = `
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    
    <symbol id="success" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="error" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
    </svg>

    <div class="alert alert-${type == "success" ? "success" : "danger"}
    d-inline-flex align-items-center fade show p-3 mt-2" role="alert">   
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#${type}"/></svg>        
        <div>
            ${message}
        </div>
    </div>`
    let messageBox = document.getElementById("messageBox");
    messageBox.innerHTML = alert;
    setTimeout(() => {
        bootstrap.Alert.getOrCreateInstance(messageBox.querySelector(".alert")).close()
    }, 1000 * 20);
}

const FieldEmpty = (field) => {
    const removeEmpty = () => this.classList.remove("empty");
    field.title = ""
    field.classList.add("empty");
    field.onchange = removeEmpty;
    field.addEventListener("keydown", removeEmpty);
}
const isOkeverythingFields = function () {
    let response = true;
    let fields = document.querySelectorAll("[required]");
    fields.forEach(field => {
        if (field.value == '' || field.value == undefined || field.value == null || field.value == -1) {
            response = false;
            FieldEmpty(field);
        }
    })
    return response;
}


const Login = async (e) => {
    e.preventDefault();
    if (isOkeverythingFields()) {
        let user = document.getElementById("user").value;
        let password = document.getElementById("password").value;
        const btn = document.getElementById("btnLogin");
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Logoneando...`;
        btn.disabled = true;
        let response = await fetch("./api/auth/login",
            {
                method: "POST",
                body: JSON.stringify({
                    user,
                    password
                })
            });
        btn.innerText = "Login";
        btn.disabled = false;
        if (response.status == 200) {
            location.reload();
        } else {
            let error = await response.json();
            writeMessage(`${error.error}: ${error.message}`, "error");
        }
    }
}
const UploadFile = async (e) => {
    e.preventDefault();
    try {

        if (isOkeverythingFields()) {
            let data = new FormData();
            const files = document.getElementById("file").files;
            const btn = document.getElementById("btnUploadFile");
            btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Subiendo...`;
            btn.disabled = true;
            for (const file of files) {
                data.append('file[]', file, file.name)
            }


            data.append("product", document.getElementById("product").value);
            data.append("type", document.getElementById("type").value);
            data.append("date", document.getElementById("date").value);

            let response = await fetch(e.target.action, {
                method: "POST",
                mode: 'cors',
                headers: {
                    "Authorization": "Bearer " + document.getElementById("token").value,
                    'Access-Control-Allow-Origin': '*',
                },
                body: data
            });
            btn.innerText = "Subir";
            btn.disabled = false;
            if (response.status == 204) {
                writeMessage("archivo subido correctamente", "success");
            } else {
                let error = await response.json();
                writeMessage(`${error.error}: ${error.message}`, "error");
            }
        }
    } catch (error) {
        writeMessage(`${error.message}`, "error");

    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("Login")) {
        document.getElementById("Login").onsubmit = Login;
    } else {
        document.getElementById("uploadFile").onsubmit = UploadFile;
    }


})