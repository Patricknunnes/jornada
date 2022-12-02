<div class="header">
    <div class="container infos">
        <h4>Criar Região</h4>
        <p>Home - Região - Cadastrar </p>
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="cadastro1">
            <form action="<?= base_url('') ?>index.php/paginas/store" enctype="multipart/form-data" class="" method="post">
                <h5>Região</h5>
                <div class="row col-md-12 mt-5">
                    <div class=" shadow"><img id="icone-preview" src="<?= base_url('') ?>assets/img/icones/regiao.png" height="200" width="200"></div>
                    <input class="default-btn" id="img-upload-icone" name="img-upload-icone" type="file" hidden>
                    <button onclick="defaultBtnActive()" type="button" id="custom-btn" class="btn mt-3">Trocar Ícone</button>
                    <button onclick="defaultBtnClean()" type="button" id="custom-btn-clear" class="btn mt-3">Limpar Ícone</button>
                </div>

                <div class="form-group mt-5">
                    <label for="nome">Título</label>
                    <input type="text" class="form-control" name="titulo" value="" id="titulo" placeholder="Digite o título: ">
                </div>	

                <div class="form-group mt-5">
                    <label for="descricao">Descrição List</label>
                    <textarea class="form-control" cols="10" id="descricao" name="descricao" placeholder="Digite a descrição apresentada na pesquisa: "></textarea>
                </div>
                
                <div class="form-group mt-5">
                    <label for="dash_descricao">Descrição Dashboard</label>
                    <textarea class="form-control" cols="10" id="dash_descricao" name="dash_descricao" placeholder="Digite a descrição apresentada no dashboard: "></textarea>
                </div>

                <div class="row col-md-12 mt-5">
                    <div class=" shadow"><img id="banner-preview" src="<?= base_url('') ?>assets/img/banner.png" height="305" width="200"></div>
                    <input class="banner-btn" id="img-upload-banner" name="img-upload-banner" type="file" hidden>
                    <button onclick="bannerBtnActive()" type="button" id="banner-btn" class="btn mt-3">Trocar Banner</button>
                    <button onclick="bannerBtnClean()" type="button" id="banner-btn-clear" class="btn mt-3">Limpar Banner</button>
                </div>
                
                <div class="row justify-content-between mt-5">
                    <div class="col mr-5">
                        <button type="button" class="btn btn-danger"><a href="<?= base_url('') ?>index.php/paginas" style=" text-decoration:none; color: white; font-family: Poppins;">Cancelar</a> </button>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" style="font-family: Poppins;">Gravar</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

</div>
<script>
    const iconeFile= document.querySelector("#img-upload-icone");
    const imgIcone = document.querySelector("#icone-preview");

    const bannerFile= document.querySelector("#img-upload-banner");
    const imgBanner = document.querySelector("#banner-preview");

    function defaultBtnActive() {
        iconeFile.click();
    }

    iconeFile.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const result = reader.result;
                imgIcone.src = result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    function defaultBtnClean() {
        iconeFile.value = "";
        imgIcone.src="<?= base_url('') ?>assets/img/icones/regiao.png";
    }
    
    
    function bannerBtnActive() {
        bannerFile.click();
    }

    bannerFile.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const result = reader.result;
                imgBanner.src = result;
            };
            reader.readAsDataURL(file);
        }
    });
    
    function bannerBtnClean() {
        bannerFile.value = "";
        imgBanner.src="<?= base_url('') ?>assets/img/banner.png";
    }
    
</script>