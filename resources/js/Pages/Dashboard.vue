<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Stock</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Supplies</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            
                            <div class="row mt-4">
                                <div class="col-sm-8">
                                    <hr>
                                    <div class="table-wrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product name</th>
                                                <th scope="col">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr v-for="(product, index) in this.products" :key="index">
                                                    <th scope="row">{{ index }}</th>
                                                    <td>{{ product.name }}</td>
                                                    <td>{{ product.quantity }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-10"> 
                                            <input 
                                                type="text" 
                                                class="form-control form-control-sm" 
                                                placeholder="Product name"
                                                v-model="stock"
                                                > 
                                        </div>
                                        <div class="col-sm-2">

                                            <button class="btn btn-sm btn-primary" @click="addStock">Add stock</button> 
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-sm-4">
                                    <p> <b> Get Price </b> </p>
                                    <hr>
                                    <div>
                                        <select class="form-select form-select-sm" v-model="stock_date.stock_id">
                                            <option v-for="(product, index) in this.products" :value="product.id" :key="index">
                                                    {{  product.name  }}
                                            </option>
                                        </select> 
                                    </div>                                   
                                    <div class="mt-2">
                                        <input type="date" class="form-control form-control-sm" v-model="stock_date.date"> 
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-sm btn-primary" @click="getPrice">Get</button>
                                    </div>

                                    <div class="mt-2">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr> 
                                                    <td>{{ supp.product }}</td>                                                                                              
                                                    <td>{{ supp.quantity }}</td>    
                                                    <td>{{ supp.price }}</td>                                                                                                                                       
                                                </tr>
                                            </tbody>
                                        </table>
                                     </div>                                     
                                </div> 
                              
                           </div>

                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="mt-4 row">
                                
                                <div class="table-wrap col-sm-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Number</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <tr v-for="(supply, index) in this.supplies" :key="index">
                                                <th scope="row">{{ index }}</th>
                                                <td>{{ supply.number }}</td>
                                                <td>{{ supply.price }}</td>
                                                <td>{{ supply.quantity }}</td>    
                                                <td>{{ supply.stock.name }}</td> 
                                                <td>{{  dateFormatPrint(supply.created_at)  }} </td>                                                                                                                                         
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-4">
                                    <p><b>Add supply</b></p>
                                    <hr>                                    
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <select class="form-select form-select-sm" v-model="supply.stock_id">
                                                <option v-for="(product, index) in this.products" :value="product.id" :key="index">
                                                        {{  product.name  }}
                                                </option>
                                            </select>
                                        </div> 
                                        <div class="col-sm-4">
                                            <select class="form-select form-select-sm" v-model="supply.type">
                                                <option value="1">supply</option>
                                                <option value="0">shipment</option>                                                
                                            </select>
                                        </div>                                                                            
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-sm-4">
                                            <label>Quantity</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Quantity" v-model="supply.quantity">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Number</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Number" v-model="supply.number">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Price</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Price" v-model="supply.price">
                                        </div>   
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-sm btn-primary" @click="addSupply">Add supply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import axios from 'axios'
export default {

    data(){
        return{
            products: {},
            supplies: {},
            stock:null,
            stock_date:{
                date:null
            },           
            supply: {
                type: 1,
                price: 0
            },
            supp: {}
        }
    },
    mounted(){

        this.getProducts() 
        this.getSupplies()   
    },
    methods:{

        getProducts(){     
            axios.get('/api/stock' ).then(res=>{ 

                this.products = res.data.data 
                this.supply.stock_id = this.products[0]['id']
                this.stock_date.stock_id = this.products[0]['id']

            }).catch(err=>{
                console.log(err.response)
            })          
        },

        getSupplies(){
            axios.get('/api/supply' ).then(res=>{  

                this.supplies = res.data.data 

            }).catch(err=>{
                console.log(err.response)
            }) 
        },
        dateFormatPrint(str){

            return str.split('T')[0] +" "+ str.split('T')[1].split('.')[0]            
        },
        addStock(){            
            axios.post('/api/stock', {'name': this.stock} ).then(res => {

                this.stock = null
                this.getProducts()
                        
            }).catch(err => { 
                console.log(err.response) 
            })                    
        },
        addSupply(){

            if(  Number(this.supply.type) == 0 ){

                this.supply.quantity = this.supply.quantity - ( this.supply.quantity * 2 )
            }
                 
            console.log(this.supply)
                     
            axios.post('/api/supply', this.supply ).then(res => {

                console.log(res)
                this.stock = null
                this.getProducts()
                this.getSupplies()
                    
            }).catch(err => { 
                console.log(err.response) 
            })                 
        },
        getPrice(){

            console.log(this.stock_date)

            if(!this.stock_date.date){
                alert('Date Error');
            }
           
            axios.post('/api/price', this.stock_date ).then(res => {

            this.supp.product = res.data.supply.stock.name                                                                                           
            this.supp.quantity = res.data.supply.stock.quantity
            this.supp.price = res.data.price
               
            }).catch(err => { 
                console.log(err.response) 
                if(err.response.status == 404){
                    alert("Not Found")
                }
            })  
                          

        }         
    }
}
</script>
<style scoped>
   .table-wrap{
        height: 300px;
        overflow-y: scroll;
        font-size: 12px;
   }
</style>>