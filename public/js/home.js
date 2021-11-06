function AddTarefa(lista)
{
	var listas = document.getElementById("Lista"+lista).children[1]
	var size = parseInt((listas.children.length + 1) / 2);
	if (size > 0) listas.appendChild(document.createElement("hr"));
	var tarefa = document.createElement("p");
	tarefa.innerText = "Tarefa " + lista + "." + (size+1);
	listas.appendChild(tarefa);
}

function ShowCriarLista(state)
{
	var newlist = document.getElementsByClassName("main-content-list_new-list")[0];
	var h1 = state ? 'hidden' : '';
	var h2 = state ? '' : 'hidden';
	newlist.children[0].className = h1;
	newlist.children[1].className = h2;
	newlist.children[2].className = h2;
	newlist.children[3].className = h2;
}

function AddLista()
{
	var input = document.getElementsByClassName("main-content-list_new-list")[0].children[1];
	var nome = input.value;
	input.value = "";
	var listas = document.getElementById("Listas");
	var listaout = document.createElement("div");
	var lista = document.createElement("div");
	lista.appendChild(document.createElement("span"));
	lista.appendChild(document.createElement("span"));
	lista.appendChild(document.createElement("span"));
	lista.children[0].appendChild(document.createElement("h1"));
	lista.children[2].appendChild(document.createElement("button"));
	listaout.className = "main-content-list_list";
	lista.id = "Lista" + nome;
	lista.children[0].children[0].innerText = nome;
	lista.children[2].children[0].innerText = "+";
	lista.children[2].children[0].addEventListener('click', function(){ AddTarefa(nome); });
	listaout.appendChild(lista);
	listas.insertBefore(listaout,listas.children[listas.children.length-1]);
	ShowCriarLista(false);
	UpdateBodyWidth();
	var url =  window.location.origin + "/user/home/new_list?nome=" + nome;
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url);

	xhr.onreadystatechange = function () {
	   if (xhr.readyState === 4)
	   {
	      if (xhr.responseText == 'sucesso')
	      {
	      	listas.insertBefore(listaout,listas.children[listas.children.length-1]);
			ShowCriarLista(false);
			UpdateBodyWidth();
	      }
	   }
	};
	xhr.send();
}

function UpdateBodyWidth()
{
	document.documentElement.style.setProperty("--bodywidth", document.body.scrollWidth+"px");
}

function SetVw() 
{
	UpdateBodyWidth();
	var vw = document.documentElement.clientWidth / 100;
	document.documentElement.style.setProperty("--vw", vw+"px");
}

//SetVw();
window.addEventListener("resize", SetVw);

window.onload = SetVw;