</body>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<!--<script src="http://code.jquery.com/jquery-3.5.1.js"></script>-->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="<?= base_url() ?>assets/js/img-upload1.js"></script> -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/perguntas.js?<?php echo mt_rand()?>"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
function showif(campo){
$.ajax({
				url: "<?php echo  base_url() ?>index.php/pesquisas/pesquisashowif",
				type: "POST",
				data: 'campo='+campo,
				beforeSend: function() {
					console.log('Carregando');
				},
				success: function(data) {
					var at = $("#div_"+data).attr('data-showif'); 
					var retorno = at.split(" ");
					console.log($("input[name="+retorno[0]+"]:checked").val() );
					if($("input[name="+retorno[0]+"]:checked").val() >= retorno[2]){
						$("#div_"+data).show();	
					}else{
						$("#div_"+data).hide();	
					}
					
					console.log(retorno);

				},
				error: function(e) {
					console.log(e);
				}
			});

}
<?php 
if(isset($page_id2) && isset($page_id) && isset($rest)){ 
    if (! $rest) {?>

document.querySelectorAll('img').forEach((item, index) => {
    setTimeout(() => {
      //  console.log(item);	
      var atributo = item.getAttribute('src'); 
     // console.log(atributo);

	  $.ajax({
				url: "<?php echo  base_url() ?>index.php/Graphic",
				type: "POST",
				data: 'page_id2=<?php echo $page_id2; ?>&url='+atributo+'&pesquisa=<?php echo $page_id; ?>',
				beforeSend: function() {
					console.log('Carregando')
				},
				success: function(data) {
					console.log(data);
				},
				error: function(e) {
					console.log(e);
				}
			});

    }, index * 200);
  });
<?php 

    } 
}
?>

	

	google.charts.load('current', {
		'packages': ['corechart']
	}).then(function () {
            google.charts.setOnLoadCallback(drawChart);
        });

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['Year', 'Sales', 'Expenses'],
			['2004', 1000, 400],
			['2005', 1170, 460],
			['2006', 660, 1120],
			['2007', 1030, 540]
		]);

		var options = {
			title: 'Company Performance',
			curveType: 'function',
			legend: {
				position: 'bottom'
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

		chart.draw(data, options);
	}

	google.charts.load('current', {
		'packages': ['corechart']
	}).then(function () {
            google.charts.setOnLoadCallback(drawChart);
        });

	function drawChart() {

		var data = google.visualization.arrayToDataTable([
			['Task', 'Hours per Day'],
			['Work', 11],
			['Eat', 2],
			['Commute', 2],
			['Watch TV', 2],
			['Sleep', 7]
		]);

		var options = {
			title: 'My Daily Activities'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));

		chart.draw(data, options);
	}

	google.charts.load("current", {
		packages: ['corechart']
	}).then(function () {
            google.charts.setOnLoadCallback(drawChart);
        });

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			["Element", "Density", {
				role: "style"
			}],
			["Copper", 8.94, "#b87333"],
			["Silver", 10.49, "silver"],
			["Gold", 19.30, "gold"],
			["Platinum", 21.45, "color: #e5e4e2"]
		]);

		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
			{
				calc: "stringify",
				sourceColumn: 1,
				type: "string",
				role: "annotation"
			},
			2
		]);

		var options = {
			title: "Density of Precious Metals, in g/cm^3",
			width: 600,
			height: 400,
			bar: {
				groupWidth: "95%"
			},
			legend: {
				position: "none"
			},
		};
		var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
		chart.draw(view, options);
	}

	google.charts.load("current", {
		packages: ["corechart"]
	}).then(function () {
            google.charts.setOnLoadCallback(drawChart);
        });

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			["Element", "Density", {
				role: "style"
			}],
			["Copper", 8.94, "#b87333"],
			["Silver", 10.49, "silver"],
			["Gold", 19.30, "gold"],
			["Platinum", 21.45, "color: #e5e4e2"]
		]);

		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
			{
				calc: "stringify",
				sourceColumn: 1,
				type: "string",
				role: "annotation"
			},
			2
		]);

		var options = {
			title: "Density of Precious Metals, in g/cm^3",
			width: 600,
			height: 400,
			bar: {
				groupWidth: "95%"
			},
			legend: {
				position: "none"
			},
		};
                if (document.getElementById("barchart_values")){
                    var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
                    chart.draw(view, options);
            }
	}

	function adicionarPesquisa(id) {
		$(document).ready(function(e) {
                    if ($('#link_formr').val() == ""){
                        alert("Deve ser selecionada uma Pesquisa.");
                        return;
                    }
			$.ajax({
				url: "<?php echo  base_url() ?>index.php/Paginas/setPesquisa",
				type: "POST",
				data: 'pag_id=' + id + '&run_titulo=' + $("#link_formr option:selected").text() + '&id=' + $('#link_formr').val(),
				beforeSend: function() {
					$("#err").fadeOut();
				},
				success: function(data) {
					$('#table-page').append(data);                                        
                                        $("#link_formr option:selected").remove();
					sendEmail();
				},
				error: function(e) {
					$("#err").html(e).fadeIn();
				}
			});
		});
	}

	function sendEmail() {
		$(document).ready(function(e) {
			$.ajax({
				url: "<?php echo  base_url() ?>index.php/Paginas/send_mail",
				type: "POST",
			});
		});
	}

	$('#msg-delete-regiao').hide();

	function deletarRegiaoPage(id, pag_id) {
		$(document).ready(function(e) {
			$.ajax({
				url: "<?php echo  base_url() ?>index.php/paginas/destroyPesquisa",
				type: "POST",
				data: 'id=' + id + '&pag_id=' + pag_id,
				beforeSend: function() {
					$("#err").fadeOut();
				},
				success: function(data) {
					$('#msg-delete-regiao').show();
					document.getElementById(id).remove();
                                        
				},
				error: function(e) {
					$("#err").html(e).fadeIn();
				}
			});
		});
	}

	function fecharalert() {
		$('#msg-delete-regiao').hide();
	}

	$("#proximo-0").click(function() {
		$(".content-perguntas-1").css("display", "block");
		$(".content-perguntas-0").css("display", "none");
	});

	$("#proximo-1").click(function() {
		$(".content-perguntas-2").css("display", "block");
		$(".content-perguntas-1").css("display", "none");
	});
	$("#voltar-1").click(function() {
		$(".content-perguntas-0").css("display", "block");
		$(".content-perguntas-1").css("display", "none");
	});

	$("#proximo-2").click(function() {
		$(".content-perguntas-3").css("display", "block");
		$(".content-perguntas-2").css("display", "none");
	});
	$("#voltar-2").click(function() {
		$(".content-perguntas-1").css("display", "block");
		$(".content-perguntas-2").css("display", "none");
	});

	$("#proximo-3").click(function() {
		$(".content-perguntas-4").css("display", "block");
		$(".content-perguntas-3").css("display", "none");
	});
	$("#voltar-3").click(function() {
		$(".content-perguntas-2").css("display", "block");
		$(".content-perguntas-3").css("display", "none");
	});

	$("#proximo-4").click(function() {
		$(".content-perguntas-5").css("display", "block");
		$(".content-perguntas-4").css("display", "none");
	});
	$("#voltar-4").click(function() {
		$(".content-perguntas-3").css("display", "block");
		$(".content-perguntas-4").css("display", "none");
	});

	function exitRegiao(page_id){
		$(".alert_regiao").css("display", "none");
		$("#overlay_regiao").css("display", "none");


		$.ajax({
			url: "<?php echo  base_url() ?>index.php/dashboard/update_gif_regiao/" + page_id,
			type: "POST",
		});
	}

        var processandoORP = false;
        function OrdenarRegiaoPages( ordem1, ordem2, jornada) {
            if (processandoORP) {
                alert("Aguarde a ordena????o anterior");
                return;
            }
            var regiao1 = $("#regiao"+jornada+ordem1); 
            var regiao2 = $("#regiao"+jornada+ordem2);
                        
            processandoORP = true;
            
            $.ajax({
                url: "<?php echo  base_url() ?>index.php/paginas/ordenarProcessa",
                type: "POST",
                data: 'ordem1='+ordem1 + '&ordem2=' + ordem2 + '&jornada=' + jornada,
                beforeSend: function() {

                },
                success: function(data) {
                    var textTemp = regiao1.text();
                    regiao1.text(regiao2.text());
                    regiao2.text(textTemp);
                    
                    if (jornada == 'N'){
                        //Guardar valores
                        var aguardar1I = $("#aguardar"+ ordem1 + " input").is(':checked');
                        var aguardar2I = $("#aguardar"+ ordem2 + " input").is(':checked');
                        //Trocar HTML
                        var aguardar1 = $("#aguardar"+ ordem1 );
                        var aguardar2 = $("#aguardar"+ ordem2);
                        var aguardaTemp = aguardar1.html();
                        aguardar1.html(aguardar2.html());
                        aguardar2.html(aguardaTemp);
                        //Ajustar checked
                        var aguardar1 = $("#aguardar"+ ordem1 + " input");
                        var aguardar2 = $("#aguardar"+ ordem2 + " input");                        
                        aguardar1.prop('checked', aguardar2I);
                        aguardar2.prop('checked', aguardar1I);
                        
                        //Guardar valores
                        var visivel1I = $("#visivel"+ ordem1 + " input").is(':checked');
                        var visivel2I = $("#visivel"+ ordem2 + " input").is(':checked');
                        //Trocar HTML
                        var visivel1 = $("#visivel"+ ordem1 );
                        var visivel2 = $("#visivel"+ ordem2 );
                        var visivelTemp = visivel1.html();
                        visivel1.html( visivel2.html());
                        visivel2.html( visivelTemp);
                        //Ajustar checked
                        var visivel1 = $("#visivel"+ ordem1 + " input");
                        var visivel2 = $("#visivel"+ ordem2 + " input");
                        visivel1.prop('checked', visivel2I);
                        visivel2.prop('checked', visivel1I);
                                                
                    }

                    processandoORP = false;

                },
                error: function(e) {
                    alert("Ocorreu um erro ao tentar mudar a ordena????o!");
                    processandoORP = false;
                }
            });
        }
        
        function AlterarAguardaJornada( regiaoId) {
            var aguardaJornada = 'N';
            if ($("#aguardarCH" + regiaoId).is(':checked')) {
                aguardaJornada = 'S';
            }

            $.ajax({
                url: "<?php echo  base_url() ?>index.php/paginas/storeAguardaJornada",
                type: "POST",
                data: 'regiaoId='+regiaoId + '&aguardaJornada=' + aguardaJornada,
                beforeSend: function() {

                },
                success: function() {

                },
                error: function(e) {
                    alert("Ocorreu um erro ao tentar salvar aguarda Jornada!");
                    processandoORP = false;
                }
            });
        }

        function AlterarSempreVisivel( regiaoId){
            var sempreVisivel = 'N';
            if ($("#visivelCH" + regiaoId).is(':checked')) {
                sempreVisivel = 'S';
            }

            $.ajax({
                url: "<?php echo  base_url() ?>index.php/paginas/storeSempreVisivel",
                type: "POST",
                data: 'regiaoId='+regiaoId + '&sempreVisivel=' + sempreVisivel,
                beforeSend: function() {

                },
                success: function() {

                },
                error: function(e) {
                    alert("Ocorreu um erro ao tentar salvar sempre vis??vel!");
                    processandoORP = false;
                }
            });
        }
        
        function salvarOrdemConclusa( ordemAtual, ordemAnt, jornada ) {
        
            var aguardaConclusa = 'N';
            if ($("#conclusa" + jornada + ordemAtual + "_" + ordemAnt).is(':checked')) {
                aguardaConclusa = 'S';
            }
            
            $.ajax({
                url: "<?php echo  base_url() ?>index.php/paginas/storeOrdemConclusa",
                type: "POST",
                data: 'ordemAtual='+ordemAtual + '&ordemAnt=' + ordemAnt + 
                        '&aguardaConclusa=' + aguardaConclusa + '&jornada=' + jornada,
                beforeSend: function() {

                },
                success: function() {

                },
                error: function(e) {
                    alert("Ocorreu um erro ao tentar mudar a ordena????o!");
                    processandoORP = false;
                }
            });
        
        }

    
</script>

</html>
