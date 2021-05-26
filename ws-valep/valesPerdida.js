class Producto {
    constructor({codigo, nombre, cantidad, precio=0, descuento=0}) {
        this.cantidad = parseInt(cantidad) || 1;
        this.codigo = codigo || '';
        this.descuento = parseFloat(descuento) || 0 ;
        this.nombre = nombre || '';
        this.precio = parseFloat(precio) || 0;
        this.iva = parseFloat(0);
    }

    getIVA(){
        return parseFloat(((this.getSubtotal() * this.iva) / 100).toFixed(2));
    }

    getDescuento(){
        return parseFloat((((this.cantidad * this.precio)* this.descuento)/100).toFixed(2));
    }

    getPeso(){
        return parseFloat((this.peso *this.cantidad).toFixed(2));
    }

    getSubtotal(){
        return parseFloat(((this.cantidad * this.precio) - this.getDescuento(this.descuento)).toFixed(2));
    }

    setPeso(peso){
        this.peso = parseFloat(peso);
    }
    
    setCantidad(cantidad){
        this.cantidad = parseInt(cantidad);
    }

    setDesuento(descuento){
        this.descuento = parseFloat(descuento);
    }
}

class Documento {
    constructor() {
        this.productos = {
            items: [],
            cantidad: 0,
            peso: 0,
            subtotal: 0,
            IVA: 0,
            total: 0
        },
        this.solicitante = null,
        this.tipoDoc = '',
        this.empresa = '',
        this.bodega
      
    }

        getCantidad() {
            this.productos.cantidad = this.productos.items.reduce( (total, producto) => {
                return total + producto.cantidad;
            }, 0);
            return this.productos.cantidad;
        }

        getPeso(){
            this.productos.peso = this.productositems.reduce( (total, producto) => { 
                return total + producto.getPeso(); 
            }, 0); 
            return this.productos.peso;
        }

        getSubTotal(){
            this.productos.subtotal = this.productos.items.reduce( (total, producto) => { 
                return total + producto.getSubtotal(); 
            }, 0);
            return this.productos.subtotal;
        }

        getIVA(){
            this.productos.IVA = this.productos.items.reduce( (total, producto) => { 
                return total + producto.getIVA(); 
            }, 0); 
            return this.productos.IVA;
        };

        getTotal(){
            return parseFloat((this.getSubTotal() + this.getIVA()).toFixed(2));
        };
}

const app = new Vue({
    el: '#app',
    data: {
        title: 'Formulario de Vales por Pérdida',
        documento : new Documento(),
        busqueda_solicitante: '',
        empresas: [],
        tiposDoc: [],
        bodegas: []
    },
    methods:{
        async init() {
            const response = await fetch(`./api/index.php?action=initform`)
                .then(response => {
                    return response.json();
                }).catch(error => {
                    console.error(error);
                });
            console.log(response);
            this.empresas = response.data.empresas;
            
        },
        async getTiposDoc(){
            const response = await fetch(`./api/index.php?action=getTiposDoc&empresa=${this.documento.empresa}`)
            .then(response => {
                return response.json();
            }).catch(error => {
                console.error(error);
            });
            console.log(response);
            this.tiposDoc = response.data;
        },
        async getBodegas(){
            const response = await fetch(`./api/index.php?action=getBodegas&empresa=${this.documento.empresa}`)
            .then(response => {
                return response.json();
            }).catch(error => {
                console.error(error);
            });
            console.log(response);
            this.bodegas = response.data;
        },
        async getEmpleado(){
            if (!this.documento.empresa) {
                alert(`Seleccione una empresa antes de buscar el solicitante.`);
                return;
            }
            let empresa = this.documento.empresa;
            let cedula = this.documento.busqueda_solicitante;
            let busqueda = JSON.stringify({cedula, empresa});
            const response = await fetch(`./api/index.php?action=getEmpleado&busqueda=${busqueda}`)
            .then(response => {
                return response.json();
            }).catch(error => {
                console.error(error);
            });
            console.log(response);
            if (response.data) {
                this.documento.solicitante = response.data;
            }
           
        },
        addNewProducto(){
                this.documento.productos.items.push(new Producto({}));
        },
        removeItem(producto){
            let index = this.documento.productos.items.findIndex( productoEnArray => {
                return productoEnArray.codigo === producto.codigo;
            });
            this.documento.productos.items.splice(index, 1);
        },
        async getProductos() {
            this.search_producto.isloading = true;
            let busqueda = JSON.stringify(this.search_producto.busqueda);
            const productos = await fetch(`./api/index.php?action=searchProductos&busqueda=${busqueda}`)
                .then(response => {
                    this.search_producto.isloading = false;
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 

            console.log(productos);
            this.search_producto.results = productos.data;
            
        },
        async getProduco(producto) {
            let empresa = this.documento.empresa;
            let codigo = producto.codigo;
            let busqueda = JSON.stringify({codigo, empresa});
            const productoDB = await fetch(`./api/index.php?action=getProducto&busqueda=${busqueda}`)
                .then(response => {
                    return response.json();
                }).catch( error => {
                    console.error(error);
                }); 

            console.log(productoDB);
            
            
        },
        async saveDocumento(){
            if (!this.validateSaveDocument()) {
                return;
            }

            console.log(this.documento);

            let formData = new FormData();
            formData.append('documento', JSON.stringify(this.documento));  
            return;
            fetch(`./api/inventario/index.php?action=saveCreacionReceta`, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data);
                swal({
                    title: "Realizado",
                    text: `Se ha generado exitosamente el ingreso #IPC ${data.transaction.newcod}`,
                    type: "success",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                    },
                    function(){
                        window.location = './index.php?action=inventario'
                    });
                
            })  
            .catch(function(error) {
                console.error(error);
            });  

            
        },
        validateSaveDocument(){
           return true;
        }
    },
    mounted(){
        this.init();
    }
 
})
