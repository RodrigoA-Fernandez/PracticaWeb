function inicializarMensajes(){
  const mensajes = document.getElementsByClassName("msg");
  for (let i = 0; i < mensajes.length; i++) {
    mensajes[i].addEventListener("click",function(){
      if(mensajes[i].classList.contains("noLeido")){
        mensajes[i].classList.remove("noLeido");
      }
      //Bucle para cerrar el resto de mensajes
      for (let j = 0; j < mensajes.length; j++) {
        const element = mensajes[j];
        if (i !== j) {
          let ocultos = element.getElementsByClassName("ocultable");
          for (let k = 0; k < ocultos.length; k++) {
            const element2 = ocultos[k];
            if(!element2.classList.contains("oculto")){
              element2.classList.add("oculto");
            }
          }
        }
        
      }
       
      //Bucle para abrir/cerrar el clicado
      var hijos = mensajes[i].getElementsByClassName("ocultable");
      for (let j = 0; j < hijos.length; j++) {
        if (hijos[j].classList.contains("oculto")){
          hijos[j].classList.remove("oculto");
        } else {
          hijos[j].classList.add("oculto");
        }
        
      }
    });
    
  }
}
