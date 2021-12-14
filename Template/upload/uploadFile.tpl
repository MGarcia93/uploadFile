<header>
    <h1 class="title bg-gray text-center p-3 mt-2">Carga de Paginas</h1>
</header>

<form id="uploadFile" action="<[-URL_UPLOAD-]>" method="post" enctype="multipart/form-data"
    class="border border-1 rounded-2 p-3 d-flex d-md-inline-flex flex-wrap flex-md-nowrap gap-3 justify-contetn-beetween">
    <input hidden name="token" id="token" value="<[-TOKEN-]>" required>
    <input class="form-control" type="text" id="product" name="product" placeholder="prefijo de seccion" maxlength="3"
        required>
    <input class="form-control" type="file" id="file" name="file[]" multiple required>
    <select class=" form-select col-12 col-md-4" id="type" name="type" style="max-width: 5rem;">
        <option value="pdf">pdf</option>
        <option value="image">image</option>
        <option value="zip" disable>zip</option>
    </select>
    <input class="form-control" type="date" name="date" required id="date" />
    <button type="submit" class="btn btn-primary align-items-center gap-2 d-inline-flex" id="btnUploadFile">
        Subir
    </button>




</form>