<script>

    const iconeFile= document.querySelector("#img-upload-icone");
    const imgIcone = document.querySelector("#icone-preview");
    const iconeRemover = $("#chk-icone-remover");

    const bannerFile= document.querySelector("#img-upload-banner");
    const imgBanner = document.querySelector("#banner-preview");
    const bannerRemover = $("#chk-banner-remover");

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
                iconeRemover.prop("checked", false);
            };
            reader.readAsDataURL(file);
        }
    });
    
    function defaultBtnClean() {
        iconeFile.value = "";
        iconeRemover.prop("checked", true);
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
                bannerRemover.prop("checked", false);
            };
            reader.readAsDataURL(file);
        }
    });
    
    function bannerBtnClean() {
        bannerFile.value = "";
        bannerRemover.prop("checked", true);
        imgBanner.src="<?= base_url('') ?>assets/img/banner.png";
    }
    
</script>    