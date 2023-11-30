console.log("Verificando recarga");
if (document.cookie.indexOf("reloaded=true") === -1) {
  console.log("No recargado, estableciendo cookie y recargando");
  document.cookie = "reloaded=true; max-age=0";
  location.reload(true);
} else {
  console.log("Ya recargado, evitando bucle");
}
