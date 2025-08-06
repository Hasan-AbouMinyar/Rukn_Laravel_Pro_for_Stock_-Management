<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm rounded-lg border-0">
                    <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between" style="min-height: 70px;">
                        <h4 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.7rem; letter-spacing: 0.5px;">Purchase <span class="mx-2">|</span> Stock <span class="badge bg-primary text-white ms-2" style="font-size: 1rem;">{{total}}</span></h4>
                        <div class="card-tools d-flex gap-2">
                            <button @click="csvExport(csvData)" class="btn btn-light border text-dark fw-semibold shadow-sm px-4 py-2 rounded-pill">Export as CSV</button>
                            <button type="button" class="btn btn-outline-primary fw-semibold shadow-sm px-4 py-2 rounded-pill" @click.prevent="create">
                                <i class="fas fa-plus me-2"></i> Purchase
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="row align-items-center g-2">
                                <div class="col-md-2">
                                    <strong>Search by :</strong>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="queryFiled" class="form-control rounded-pill px-3" id="fileds">
                                        <option value="product">Product Name</option>
                                        <option value="supplier">Supplier Name</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <input v-model="query" type="text" class="form-control rounded-pill px-3" placeholder="Search...">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-light border shadow-sm rounded-pill w-100" @click.prevent="reload">
                                        <i class="fas fa-sync me-2"></i> Reset Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- table  -->
                        <div class="table-responsive rounded-4 shadow-sm">
                            <table class="table table-hover table-borderless align-middle mb-0 overflow-hidden" style="border-radius: 1.2rem; background: #fafbfc;">
                                <thead class="table-light" style="border-radius: 1.2rem 1.2rem 0 0;">
                                    <tr style="font-size: 1rem; border-radius: 1.2rem 1.2rem 0 0; overflow: hidden;">
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; border-top-left-radius: 1.2rem; border-bottom: 1.5px solid #e5e7eb; background: #f8f9fa;">Stock Id</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Product Name</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Supplier</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Product Quantity</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Retail Price</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Sale Price</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; border-top-right-radius: 1.2rem; border-bottom: 1.5px solid #e5e7eb; background: #f8f9fa;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="purchase in purchases" :key="purchase.id" class="bg-white border-bottom border-light" style="vertical-align: middle; transition: background 0.2s;" v-if="purchases && purchases.length">
                                        <th scope="row" class="text-muted text-start">{{ purchase.id }}</th>
                                        <td class="text-start"><a @click.prevent="showProductDetails(purchase)"
                                        class="text-primary fw-semibold" style="cursor:pointer">{{ purchase.product && purchase.product.name ? purchase.product.name : '-' }}</a></td>
                                        <td class="text-start"><a @click.prevent="showSupplierDetails(purchase)"
                                        class="text-primary fw-semibold" style="cursor:pointer">{{ purchase.supplier && purchase.supplier.name ? purchase.supplier.name : '-' }}</a></td>
                                        <td class="text-start">{{ purchase.product_quantity }}</td>
                                        <td class="text-start">{{ purchase.retail_price | currency}}</td>
                                        <td class="text-start">{{ purchase.sale_price | currency}}</td>
                                        
                                        <td class="text-start">
                                            <button type="button" @click.prevent="show(purchase)" class="btn btn-light border-0 btn-sm rounded-circle me-1 shadow-none" title="View">
                                                <i class="fas fa-eye text-primary"></i>
                                            </button>
                                            <button type="button" @click.prevent="edit(purchase)" class="btn btn-light border-0 btn-sm rounded-circle me-1 shadow-none" title="Edit">
                                                <i class="fas fa-edit text-success"></i>
                                            </button>
                                            <button type="button" @click.prevent="destroy(purchase)" class="btn btn-light border-0 btn-sm rounded-circle shadow-none" title="Delete">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="!purchases || !purchases.length">
                                        <td colspan="7">
                                            <div class="alert alert-danger text-center m-0 py-3 rounded-3" role="alert">Sorry :( No data found.</div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                </table>
                                <div class="pt-3">
                                    <pagination-component v-if="pagination.last_page > 1"
                                        :pagination="pagination"
                                        :offset="5"
                                        @paginate="query === '' ? getData() : searchData()"></pagination-component>
                                </div>
                        </div>

                        <!-- end table -->
                    </div>
                </div>

                  <!-- Modal -->
                <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">

                            <h5 v-if="showMode == true" class="modal-title text-info" id="exampleModalLongTitle">Purchases Details for <strong>{{ showDetails.product.name }}</strong> </h5>
                            <h5 v-else class="modal-title text-primary" id="exampleModalLongTitle">{{ editMode ? "Edit" : "Add New"}}  Employee</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <form v-if="showMode == false" @submit.prevent=" editMode ? update() : store()" @keydown="form.onKeydown($event)">
                        <div class="modal-body">
                          <alert-error :form="form" message="There were some problems with your input."></alert-error>
                                
                                <div class="form-group">
                                <label>Select Product </label>
                                    <select v-model="form.product_id" name="product_id" required 
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('product_id') }" placeholder="Select Category">
                                        <option v-for="product in products" :key="product.id" v-bind:value="product.id">{{ product.name }}</option>
                                    </select>
                                <has-error :form="form" field="product_id"></has-error>
                                </div>
                                <p v-if="form.errors.has('product_id')" class="text-primary">This Product Has Already Purchase, If You Need You Can Update Info !</p>

                                <div class="form-group">
                                <label>Select Supplier </label>
                                    <select v-model="form.supplier_id" name="supplier_id"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('supplier_id') }" placeholder="Select Subblier">
                                        <option v-for="supplier in suppliers" :key="supplier.id" v-bind:value="supplier.id">{{ supplier.name }}</option>
                                    </select>
                                <has-error :form="form" field="supplier_id"></has-error>
                                </div>
                                <div class="form-group">
                                <label>{{ editMode ? "New Quantity - thst's will add to old quantity" : "Product Quantity"}} </label>
                                    <input v-model="form.product_quantity" type="number" name="product_quantity" placeholder="Enter Product Quantity" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('product_quantity') }">
                                <has-error :form="form" field="product_quantity"></has-error>
                                </div>
                                <div class="form-group">
                                <label>Retail Price</label>
                                    <input v-model="form.retail_price" type="number" name="retail_price" placeholder="Enter Product Retail Price" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('retail_price') }">
                                <has-error :form="form" field="retail_price"></has-error>
                                </div>
                                <div class="form-group">
                                <label>Sale Price</label>
                                    <input v-model="form.sale_price" type="number" name="sale_price" placeholder="Enter Product Sale Price" 
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('sale_price') }">
                                <has-error :form="form" field="sale_price"></has-error>
                                </div>

                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
                        </div>
                         </form>
                        <!-- show purchase details -->
                          <div v-if="showMode ==  true" class="modal-body">
                              <div class="card border-info mb-3">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Product Name : </strong> {{ showDetails.product.name }}</li>
                                        <li class="list-group-item"> <strong>Category Name : </strong> {{ showDetails.product.cat_name }}</li>
                                        <li class="list-group-item"><strong>Product Code : </strong> {{ showDetails.product.code }}</li>
                                        <li class="list-group-item"><strong>Retail Price : </strong> {{ showDetails.retail_price | currency }}</li>
                                        <li class="list-group-item"><strong>Sale Price : </strong> {{ showDetails.sale_price | currency}}</li>
                                        <li class="list-group-item"><strong>Product Details : </strong> {{ showDetails.product.description }}</li>

                                        <li class="list-group-item"> <strong>Supplier Name : </strong> {{ showDetails.supplier.name }}</li>
                                        <li class="list-group-item"> <strong>Supplier Company : </strong> {{ showDetails.supplier.company_name }}</li>
                                        <li class="list-group-item"> <strong>Supplier Phone : </strong> {{ showDetails.supplier.phone }}</li>
                                        <li class="list-group-item"> <strong>Supplier E-mail : </strong> {{ showDetails.supplier.email }}</li>
                                        <li class="list-group-item"><strong>Employee Type : </strong> {{ showDetails.supplier.is_admin ? 'Admin' : 'Employee' }}</li>
                                        <li class="list-group-item"><strong>Created At : </strong> {{ showDetails.created_at | mydate }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                          </div>
                          <!-- show Single Product Details -->
                          <div v-if="showProMode ==  true" class="modal-body">

                              <div class="card border-info mb-3">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Product Name : </strong> {{ showDetails.name }}</li>
                                        <li class="list-group-item"> <strong>Category Name : </strong> {{ showDetails.cat_name }}</li>
                                        <li class="list-group-item"><strong>Product Code : </strong> {{ showDetails.code }}</li>
                                        <li class="list-group-item"><strong>Created At : </strong> {{ showDetails.created_at | mydate }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                          </div>
                          <!-- show single Supplier Detais -->
                          <div v-if="showSupplierMode ==  true" class="modal-body">

                              <div class="card border-info mb-3">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Supplier Name : </strong> {{ showDetails.name }}</li>
                                        <li class="list-group-item"><strong>Supplier Company : </strong> {{ showDetails.company_name }}</li>
                                        <li class="list-group-item"><strong>Phone : </strong> {{ showDetails.phone }}</li>
                                        <li class="list-group-item"><strong>E-mail : </strong> {{ showDetails.email }}</li>
                                        <li class="list-group-item"><strong>Created At : </strong> {{ showDetails.created_at | mydate }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                          </div>
                          <!--  -->
                        </div>
                    </div>
                </div>
            <!-- end modal  -->
            <!-- moadal 2  -->
            <div class="modal fade" id="ModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary" id="exampleModalLongTitle">{{ showDetails.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- show Single Product Details -->
                          <div v-if="showProMode ==  true" class="modal-body">

                              <div class="card border-info mb-3">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Product Name : </strong> {{ showDetails.name }}</li>
                                        <li class="list-group-item"> <strong>Category Name : </strong> {{ showDetails.cat_name }}</li>
                                        <li class="list-group-item"><strong>Product Code : </strong> {{ showDetails.code }}</li>
                                        <li class="list-group-item"><strong>Created At : </strong> {{ showDetails.created_at | mydate }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                          </div>
                          <!-- show single Supplier Detais -->
                          <div v-if="showSupplierMode ==  true" class="modal-body">

                              <div class="card border-info mb-3">
                                <div class="card-body">

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>Supplier Name : </strong> {{ showDetails.name }}</li>
                                        <li class="list-group-item"><strong>Supplier Company : </strong> {{ showDetails.company_name }}</li>
                                        <li class="list-group-item"><strong>Phone : </strong> {{ showDetails.phone }}</li>
                                        <li class="list-group-item"><strong>E-mail : </strong> {{ showDetails.email }}</li>
                                        <li class="list-group-item"><strong>Created At : </strong> {{ showDetails.created_at | mydate }}</li>
                                        
                                    </ul>
                                </div>
                                </div>
                          </div>
                          <!--  -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    </div>
                    </div>
                </div>
            </div>
            <!-- moadal 2 end -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editMode : false,
                showMode : false,
                showProMode : false,
                showSupplierMode : false,
                query : "",
                queryFiled : "product",
                purchases : [],
                pagination:{
                    current_page : 1,
                },
                form : new Form({
                    id : '',
                    product_id : '',
                    supplier_id : '',
                    product_quantity : '',
                    retail_price : '',
                    sale_price : '',
                }),
                products : [],
                suppliers : [],
                showDetails : [],
                total : null,
                data :{
                    exportdata : []
                }

            }
        },
        computed: {
            csvData() {
            return this.exportdata.map(item => ({
                ...item,
            }));
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getData()
            this.getProduct()
            this.getSupplier()
            axios.get("api/allpurchase")
                    .then(res=>{
                       this.exportdata = res.data.data
                       
                    })
        },
        watch:{
            query:function(newQ,old) {
                    if(newQ === ''){
                        this.getData();
                    }else{
                        this.searchData();
                    }
                
            }
        },
        methods:{
            csvExport(arrData) {
                    let csvContent = "data:text/csv;charset=utf-8,";
                    csvContent += [
                        Object.keys(arrData[0]).join(";"),
                        ...arrData.map(item => Object.values(item).join(";"))
                    ]
                        .join("\n")
                        .replace(/(^\[)|(\]$)/gm, "");

                    const data = encodeURI(csvContent);
                    const link = document.createElement("a");
                    link.setAttribute("href", data);
                    link.setAttribute("download", "purchases.csv");
                    link.click();
                    
                },
            getData(){
                this.$Progress.start()
                axios.get('/api/purchase?page='+this.pagination.current_page)
                    .then(res=>{
                        //console.log(res.data.data)
                        this.purchases = res.data.data
                        this.pagination = res.data.meta
                        this.total = res.data.meta.total
                        this.$Progress.finish()


                    })
                    .catch(e=>{
                        console.log(e)
                        this.$Progress.fail()
                    })
            },
            getProduct(){
                 axios.get('/api/allproduct')
                    .then(res=>{
                        this.products = res.data.data
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getSupplier(){
                 axios.get('/api/allsupplier')
                    .then(res=>{
                        this.suppliers = res.data.data
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            create(){
                this.editMode = false
                this.showMode = false
                this.showProModem = false
                this.showSupplierMode = false
                
                this.form.reset()
                this.form.clear()
                $('#ModalLong').modal('show');
            },
            store(){
                this.$Progress.start()
                this.form.busy = true
                this.form.post('/api/purchase')
                    .then(res=>{
                        this.getData()
                        $('#ModalLong').modal('hide');
                        if(this.form.successful){
                            this.$Progress.finish();
                            this.$snotify.success('Purchase Successfull','Success')
                        }else{
                            this.$Progress.fail()
                            this.$snotify.error('Something wend wrong. Try aging','Error')
                        }
                    })
                    .catch(e=>{
                        this.$Progress.fail()
                        console.log(e)
                    })
            },
            edit(purchase){
                this.showMode = false
                this.showProModem = false
                this.showSupplierMode = false
                this.editMode = true
                
                this.form.reset()
                this.form.clear()
                this.form.fill(purchase)
                $('#ModalLong').modal('show');
            },
            update(){
                this.$Progress.start()
                this.form.busy = true
                this.form.put('/api/purchase/'+this.form.id)
                    .then(res=>{
                        this.getData()
                        $('#ModalLong').modal('hide');
                        if(this.form.successful){
                            this.$Progress.finish();
                            this.$snotify.success('Purchase Details Update Successfully','Success')
                        }else{
                            this.$Progress.fail()
                            this.$snotify.error('Something wend wrong. Try aging','Error')
                        }
                    })
                    .catch(e=>{
                        this.$Progress.fail()
                        console.log(e)
                    })
            },
            destroy(purchase){

                this.$snotify.clear()
                this.$snotify.confirm("You will not be able to recover this data!","Are you sure?", {
                        showProgressBar: false,
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons:[
                            {
                                text : "Yes",
                                action : toast => {
                                    this.$snotify.remove(toast.id)
                                    //console.log(product)
                                    this.$Progress.start()
                                    axios.delete('/api/purchase/'+purchase.id)
                                    .then(res=>{
                                        this.getData()
                                            this.$Progress.finish();
                                            this.$snotify.success('Purchases Detetaed!!','Success')
                                       
                                    })
                                    .catch(e=>{
                                        this.$Progress.fail()
                                        console.log(e)
                                    })
                                },
                                bold : true
                            },
                            {
                                text : "No",
                                action : toast => {
                                    this.$snotify.remove(toast.id)
                                },
                                bold : true
                            }
                            
                        ]
                    })
            },
            show(purchase){
                this.editMode = false
                this.showSupplierMode = false
                this.showProMode = false
                this.showMode = true
                
                $('#ModalLong').modal('show');
                //console.log(product)
                this.showDetails = purchase
            },
            showProductDetails(purchase){
                this.editMode = false
                this.showMode = false
                this.showSupplierMode = false
                this.showProMode = true
                $('#ModalLong2').modal('show');
                let id = purchase.product_id;
                //console.log(id)
                axios.get('/api/product/'+id)
                .then(res=>{
                        this.showDetails = res.data.data
                       // console.log(res.data.data)
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            showSupplierDetails(purchase){
                this.editMode = false
                this.showMode = false
                this.showProMode = false
                this.showSupplierMode = true
                $('#ModalLong2').modal('show');
               let id = purchase.supplier_id;
                //console.log(id)
                axios.get('/api/supplier/'+id)
                .then(res=>{
                        this.showDetails = res.data.data
                        //console.log(res.data.data)
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            searchData(){
                if (!this.query) {
                    this.getData();
                    return;
                }
                this.$Progress.start();
                axios.get('/api/search/purchase/'+this.queryFiled+'/'+this.query+'?page='+this.pagination.current_page)
                    .then(res=>{
                        // معالجة الاستجابة بشكل آمن
                        if (res.data && Array.isArray(res.data.data) && res.data.data.length > 0) {
                            this.purchases = res.data.data;
                            this.pagination = res.data.meta || { current_page: 1, last_page: 1, total: 0 };
                        } else {
                            this.purchases = [];
                            this.pagination = { current_page: 1, last_page: 1, total: 0 };
                        }
                        this.$Progress.finish();
                    })
                    .catch(e=>{
                        this.$Progress.fail();
                        this.purchases = [];
                        this.pagination = { current_page: 1, last_page: 1, total: 0 };
                        console.log(e);
                    })
            },
            reload(){
                this.getData();
                this.query = '';
                this.queryFiled = 'product';
                this.$snotify.info('Search reset', {
                    timeout: 1000,
                    showProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: false
                });
            },

        }
    }
</script>
