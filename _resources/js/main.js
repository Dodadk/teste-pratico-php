/**

* @author Douglas Pierre
* @company BaseTech TI SoluÃ§Ãµes e Tecnologias
* @mail basetechti@gmail.com
* @packageName Classe de ManipulaÃ§Ã£o de tabelas SQL
* @package v1.0
*/

var HostName = window.location.hostname;
var Protocolo = window.location.protocol;
var WWW = Protocolo + "//" + HostName +"/"+ window.location.pathname;

$(document).ready(function() {
	var WWWROOT = $("body").attr("www");
	var gSubTotal = 0;
	function dump(obj) {
		var out = '';
		for (var i in obj) {
			out += i + ": " + obj[i] + "\n";
		}

		alert(out);
		var pre = document.createElement('pre');
		pre.innerHTML = out;
		document.body.appendChild(pre)
	}
	$("body").on("click","button.btn-next-page",function(){

		var count = parseInt($("ul.product-list-added div#produts-list").attr("count"));
		if(count>0){
			window.location = WWWROOT+'Vendas';
		}else{
			alert("Você precisa adicionar ao menos um produtos em seu carrinho de compras!");
		}
	});
	//   ------------- Pagina de Login ------------------//
	$("body").on("click","button.btn-login",function(){
		var user = $("input[name=user]").val();
		var pass = $("input[name=passwd]").val();
		beforeSend:$(this).addClass("btn-warning")
		.removeClass("btn-primary")
		.html('<span class="text-middle"><i class="fas fa-sync fa-spin"></i> Autenticando...</span>');
		$.post(
			WWWROOT+"_controller/LoginController.php",
			{
				user:user,
				passwd:pass,
				setting: "SignIn"
			},function(x){
				if(x.response == "authorized"){
					$("div.msg-alert").removeClass("alert-danger").addClass("alert-primary").text("Acesso autorizado com sucesso!");					
					$("div.msg-alert").fadeIn(500);
					$("button.btn-login").addClass("btn-success")
					.removeClass("btn-primary btn-warning")
					.html('<span class="text-middle"><i class="fas fa-spinner fa-spin"></i> Redirecionando...</span>');
					setTimeout(function(){					
						window.location.reload();
					}, 2000);

				}else{
					$("button.btn-login").addClass("btn-primary")
					.removeClass("btn-warning")
					.html('Entrar');
					$("div.msg-alert").removeClass("alert-primary").addClass("alert-danger").text("Usuario ou Senha InvalÃ­da.");					
					$("div.msg-alert").fadeIn(500);
				}
			},"jSON");
	});
	$("body").on("click","a.btn-logout",function(){
		$.post(
			WWWROOT+"_controller/LoginController.php",
			{
				setting: "Logout"
			},function(x){
				if(x.response == "unlogged"){
					window.location.reload();
				}
			},"jSON");
	});
//   ------------- Fim Pagina de Vendas ------------------//
//   ------------- Pagina de Vendas ------------------//
function saveAddress(){	
	var nome = $("input[name=NomeCompleto]").val();
	var nascimento = $("input[name=DataDeNascimento]").val();
	var cep = $("input[name=cep]").val();
	var endereco = $("input[name=endereco]").val();
	var numero = $("input[name=numero]").val();
	var complemento = $("input[name=complemento]").val();
	var bairro = $("input[name=bairro]").val();
	var cidade = $("input[name=cidade]").val();
	var uf = $("input[name=uf]").val();
	$.post(WWWROOT+"_controller/VendasController.php",
			{
				nome:nome,
				nascimento:nascimento,
				cep:cep,
				endereco:endereco,
				numero:numero,
				complemento:complemento,
				bairro:bairro,
				cidade:cidade,
				uf:uf,
				setting:"saveAddress"},function(x){});
	

}
function checkFieldCustomer(){
	var nome = $("input[name=NomeCompleto]").val();
	var nascimento = $("input[name=DataDeNascimento]").val();
	var cep = $("input[name=cep]").val();
	var endereco = $("input[name=endereco]").val();
	var numero = $("input[name=numero]").val();
	var complemento = $("input[name=complemento]").val();
	var bairro = $("input[name=bairro]").val();
	var cidade = $("input[name=cidade]").val();
	var uf = $("input[name=uf]").val();
	var ok = false;
	if(nome == "" || nome == " "){
	}else if(nascimento == "" || nascimento == " "){
	}else if(cep == "" || cep == " "){
	}else if(endereco == "" || endereco == " "){
	}else if(numero == "" || numero == " "){
	}else if(bairro == "" || bairro == " "){
	}else if(cidade == "" || cidade == " "){
	}else if(uf == "" || uf == " "){
	}else{
		ok = true;
	}
	return ok;

}
function readFieldsCustomer(){
	var nome = $("input[name=NomeCompleto]").val();
	var nascimento = $("input[name=DataDeNascimento]").val();
	var cep = $("input[name=cep]").val();
	var endereco = $("input[name=endereco]").val();
	var numero = $("input[name=numero]").val();
	var complemento = $("input[name=complemento]").val();
	var bairro = $("input[name=bairro]").val();
	var cidade = $("input[name=cidade]").val();
	var uf = $("input[name=uf]").val();
	var ok = false;
	if(nome == "" || nome == " "){
		alert("Por favor preencha o campo NOME!");
	}else if(nascimento == "" || nascimento == " "){
		alert("Por favor preencha o campo NASCIMENTO!");
	}else if(cep == "" || cep == " "){
		alert("Por favor preencha o campo CEP!");
	}else if(endereco == "" || endereco == " "){
		alert("Por favor preencha o campo ENDEREÃ‡O!");
	}else if(numero == "" || numero == " "){
		alert("Por favor preencha o campo NUMERO!");
	}else if(bairro == "" || bairro == " "){
		alert("Por favor preencha o campo BAIRRO!");
	}else if(cidade == "" || cidade == " "){
		alert("Por favor preencha o campo CIDADE!");
	}else if(uf == "" || uf == " "){
		alert("Por favor preencha o campo UF!");
	}else{
		ok = true;
	}
	return ok;
}
if(checkFieldCustomer()){
		$("button.btn-next-page-last").removeAttr("disabled");		
	}else{		
		$("button.btn-next-page-last").attr("disabled"," ");
	}
$("body").on("input","input",function(){
	if(checkFieldCustomer()){
		$("button.btn-next-page-last").removeAttr("disabled");		
	}else{		
		$("button.btn-next-page-last").attr("disabled"," ");
	}
});
$("body").on("input","input[name=cep]",function(){
	setTimeout(function(){
		var cep = $("input[name=cep]").val();

		$.ajax({
			method: "GET",
			url: "https://viacep.com.br/ws/"+cep+"/json/"
		}).done(function(x){

			$("input[name=endereco]").val(x.logradouro);
			$("input[name=complemento]").val(x.complemento);
			$("input[name=bairro]").val(x.bairro);
			$("input[name=cidade]").val(x.localidade);
			$("input[name=uf]").val(x.uf);
			saveAddress();
		},"jSON");
	},1000);
});
$("body").on("click","button.btn-next-page-last",function(){
	var nome = $("input[name=NomeCompleto]").val();
	var nascimento = $("input[name=DataDeNascimento]").val();
	var cep = $("input[name=cep]").val();
	var endereco = $("input[name=endereco]").val();
	var numero = $("input[name=numero]").val();
	var complemento = $("input[name=complemento]").val();
	var bairro = $("input[name=bairro]").val();
	var cidade = $("input[name=cidade]").val();
	var uf = $("input[name=uf]").val();
	if(readFieldsCustomer()==true){
		$.post(WWWROOT+"_controller/VendasController.php",
			{
				nome:nome,
				nascimento:nascimento,
				cep:cep,
				endereco:endereco,
				numero:numero,
				complemento:complemento,
				bairro:bairro,
				cidade:cidade,
				uf:uf,
				setting:"finishInvoice"},function(x){
				saveAddress();
				if(x.response == "fail"){
					alert("Desculpe!: Houve uma falha ao realizar sua compra, tente novamente!");
				}else{
					window.location = WWWROOT+"CompraRealizada/"+x.token;
				}
			},"jSON");
	}

});
//   ------------- Fim Pagina de Vendas ------------------//

//   ------------- Pagina de Compras ------------------//
var ProductObject = null;

function readProducts(){
	$.post(WWWROOT+"_controller/ProdutosController.php",
		{setting:"readSessionProducts"},function(x){	
			xs = x.Items.item;	
			var count = x.Items.countItems;
			$("span.product-count").text("Items: "+count);
			$li = "";
			if(count > 0){
				$('button.btn-next-page').removeAttr("disabled");
				$("ul.product-list-added div#produts-list").attr("count",count);
			}
			for(var i = 0; i < count; i++){	
				$li += '<li id="'+xs[i].idp+'" position="'+i+'" style="cursor:pointer;" ';
				$li += 'class="li-product-id position-product-'+i+' list-group-item d-flex justify-content-between lh-condensed">';
				$li += '<div style="word-wrap: break-word;">';
				$li += '<h6 class="my-0">'+xs[i].nome+'</h6>';
				$li += '<small style="word-wrap: break-word;">Fabricante:&nbsp;'+xs[i].fabricante+'&nbsp;-&nbsp;Fornecedor:&nbsp;'+xs[i].fornecedor+' </small>';
				$li += '</div>';
				$li += '<strong class=" text-right">'+(xs[i].qts>1?'( '+xs[i].qts+"x )": '')+'&nbsp;'+parseFloat(xs[i].preco).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
				$li += '<br><small>Total: '+parseFloat((xs[i].preco * xs[i].qts)).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</small></strong>';
				$li += '</li>';
				$li += '</li>';								
			}			
			if(count <= 0){
				$('button.btn-next-page').attr("disabled"," ");
				$("ul.product-list-added div#produts-list").attr("count",'0');
				$li = '<li id="empity" class=" list-group-item justify-content-between lh-condensed">';
				$li += '<div>';
				$li += '<h6 class="text-center" style="font-weight: normal;">Nenhum Item Adicionado !</h6>';
				$li += '</div>';
				$li += '</li>';	
					//$("ul.product-list-added ").append($sub);				
				}
				$("li.product-add-subtotal").find("strong").text(parseFloat(x.Items.subtotal).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));	
				$("ul.product-list-added div#produts-list").html($li);

			},"jSON");
}
$("body").on("click", "a.btn-qts-product",function(){
	var type = $(this).attr("id");
	var qtsc = $(this).closest("tr").find("td a.a-qts-product");
	var count = parseInt(qtsc.text());
	var qts = 0;
	if(type === "increase"){
		qts = (count + 1);
	}else{
		qts = (count - 1);		
	}
	if(qts>0)qtsc.text(qts);
});
$("body").on("click", ".li-product-hidden",function(){
	var status = $(this).attr("s_hidden");
	if(status == 'true'){

		$("ul.product-list-added div#produts-list").slideDown("fast",function(){
			$(this).css({"display":"block"});
			$(".li-product-hidden").attr("s_hidden","false");
			$(".li-product-hidden").find("h6").html('ESCONDER CARRINHO <i class="fas fa-arrow-circle-up"></i>');	
		});	
	}else{
		$("ul.product-list-added div#produts-list").slideUp("fast",function(){
			$(this).css({"display":"none"});
			$(".li-product-hidden").attr("s_hidden","true");
			$(".li-product-hidden").find("h6").html('MOSTRAR CARRINHO <i class="fas fa-arrow-circle-down"></i>');
		});			
	}

});
$("body").on("click", "ul.product-list-added div li.li-product-id",function(){
	var name = $(this).find("h6").text();
	var id = $(this).attr("position");
	ProductObject = $(this);		
	if(confirm('Deseja Realmente Apagar o Item: ' +name) == true){
		$.post(WWWROOT+"_controller/ProdutosController.php",
			{id: id, setting:"deleteProducts"},
			function(result){	
				readProducts();	
			},"jSON");
	}
});	
$("body").on("mouseenter mouseleave", "ul.product-list-added div#produts-list li.li-product-id",function(){
	if(!$(this).hasClass("bg-dark")){
		$(this).addClass("bg-dark text-white").removeClass("bg-white");
	}else{			
		$(this).addClass("bg-white").removeClass("bg-dark text-white");
	}
});
$("body").on("input", "input[name=search]",function(){
	var input = $(this).val();
	$.post(WWWROOT+"_controller/ProdutosController.php",
		{search: input, setting:"Search"},
		function(result){			
			$("div.products-list-result").html(result);
		});

});	
$("body").on("mousemove","div.list-product", function(){
	var code = $(this).find("span.product-code").text();
	var img = $(this).find("img").attr("src");
	var name = $(this).find("h6").text();
	var price = $(this).find("span.product-price").text();
	var manufacturer = $(this).find("span.product-manufacturer").text();
	var provider = $(this).find("span.product-provider").text();
	$('div.product-detail').find("img").attr("src",img);
	$('div.product-detail').find(".product-detail-code").text(code);
	$('div.product-detail').find(".product-detail-name").text(name);
	$('div.product-detail').find(".product-detail-price").text(price);
	$('div.product-detail').find(".product-detail-manufacturer").text(manufacturer);
	$('div.product-detail').find(".product-detail-provider").text(provider);

});

$("body").on("click", "a.product-add-list", function(){
	var id = $(this).closest("div.list-product").find("span.product-id").text();
	if($("ul.product-list-added").find("li#"+id).length == 1){
		alert("Esse item já esta no carrinho de compras.");
		return;
	}
	var code = $(this).closest("div.list-product").find("span.product-code").text(); 
	var img = $(this).closest("div.list-product").find("img").attr("src");
	var name = $(this).closest("div.list-product").find("h6").text();
	var price = parseFloat($(this).closest("div.list-product").find("span.product-price").text().substr(2).replace(".","").replace(",","."));
	var qts = parseInt($(this).closest("div.list-product").find("a.a-qts-product").text());
	var manufacturer = $(this).closest("div.list-product").find("span.product-manufacturer").text();
	var provider = $(this).closest("div.list-product").find("span.product-provider").text();
	var subtotal = parseFloat($("li.product-add-subtotal").find("strong").text().substr(2).replace(".","").replace(",","."));
	var newSubTotal = (subtotal + (price * qts));
	$.post(WWWROOT+"_controller/ProdutosController.php",
		{
			id:id,
			code:code,
			name:name,
			price:price,
			qts:qts,
			manufacturer:manufacturer,
			provider:provider,
			subtotal:newSubTotal,
			setting:"saveProducts"
		},
		function(x){
			if(x.response == "success"){
				var initial = parseInt($("ul.product-list-added div#produts-list").attr("count"));
				var position = $("ul.product-list-added div#produts-list").attr("count",(initial+1));
				var position  = initial;
				$("li.product-add-subtotal").remove();
				$("ul.product-list-added div#produts-list li#empity").remove();
				$li = '<li id="'+id+'" position="'+position+'" style="cursor:pointer;" class="li-product-id position-product-'+position+' list-group-item d-flex justify-content-between lh-condensed">';
				$li += '<div style="word-wrap: break-word;">';
				$li += '<h6 class="my-0" style="word-wrap: break-word;">'+name+'</h6>';
				$li += '<small style="word-wrap: break-word;">Fabricante:&nbsp;'+manufacturer+'&nbsp;-&nbsp;Fornecedor:&nbsp;'+provider+' </small>';
				$li += '</div>';
				$li += '<strong class=" text-right" >'+(qts>1?'( '+qts+"x )": '')+'&nbsp;'+price.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'';
				$li += '<br><small>Total: '+parseFloat((price * qts)).toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</small></strong>';
				$li += '</li>';
				$sub  ='<li class="product-add-subtotal list-group-item d-flex justify-content-between bg-warning">';
				$sub  +='<span><b>SUBTOTAL</b></span>';
				$sub  +='<strong>'+newSubTotal.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})+'</strong>';
				$sub  +='</li>';
				var productsCount = $("ul.product-list-added div li ").length+1;
				$("span.product-count").text("Items: "+productsCount);
				$("ul.product-list-added div#produts-list").append($li);
				$("ul.product-list-added ").append($sub);
				$('button.btn-next-page').removeAttr("disabled");	
			}else{
				alert("Falha ao adicionar o produto ao carrinho.");
			}
		},"jSON");
});	
//   ------------- Fim Pagina de Compras ------------------//
});