<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm rounded-lg border-0">
                    <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between" style="min-height: 70px;">
                        <h4 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.7rem; letter-spacing: 0.5px;">Category <span class="mx-2">|</span> <span class="badge bg-primary text-white ms-2" style="font-size: 1rem;">{{total}}</span></h4>
                        <div class="card-tools d-flex gap-2">
                            <button @click="csvExport(csvData)" class="btn btn-light border text-dark fw-semibold shadow-sm px-4 py-2 rounded-pill">Export as CSV</button>
                            <button type="button" class="btn btn-outline-primary fw-semibold shadow-sm px-4 py-2 rounded-pill" @click.prevent="create">
                                <i class="fas fa-plus me-2"></i> Add New Category
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="mb-3">
                            <div class="row align-items-center g-2">
                                <div class="col-md-2">
                                    <strong>Search By :</strong>
                                </div>
                                <div class="col-md-3">
                                    Category Name
                                </div>
                                <div class="col-md-5">
                                    <input v-model="query" type="text" class="form-control" placeholder="Search">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-light border shadow-sm rounded-pill w-100" @click="reload">
                                        <i class="fas fa-sync me-2"></i> Reset Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- table   -->
                        <div class="table-responsive rounded-4 shadow-sm">
                            <table class="table table-hover table-borderless align-middle mb-0 overflow-hidden" style="border-radius: 1.2rem; background: #fafbfc;">
                                <thead class="table-light" style="border-radius: 1.2rem 1.2rem 0 0;">
                                    <tr style="font-size: 1rem; border-radius: 1.2rem 1.2rem 0 0; overflow: hidden;">
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; border-top-left-radius: 1.2rem; border-bottom: 1.5px solid #e5e7eb; background: #f8f9fa;">Category Id</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Category Name</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; background: #f8f9fa;">Created At</th>
                                        <th scope="col" class="fw-medium text-dark py-3 border-0 border-bottom text-start" style="letter-spacing:0.02em; border-top-right-radius: 1.2rem; border-bottom: 1.5px solid #e5e7eb; background: #f8f9fa;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-show="categories.length" v-for="category in categories" :key="category.id" class="bg-white border-bottom border-light" style="vertical-align: middle; transition: background 0.2s;">
                                        <th scope="row" class="text-muted text-start">{{ category.id }}</th>
                                        <td class="text-start">{{ category.name }}</td>
                                        <td class="text-start">{{ category.created_at | mydate}}</td>
                                        <td class="text-start">
                                            <button type="button" @click.prevent="edit(category)" class="btn btn-light border-0 btn-sm rounded-circle me-1 shadow-none" title="Edit">
                                                <i class="fas fa-edit text-success"></i>
                                            </button>
                                            <button type="button" @click.prevent="destroy(category)" class="btn btn-light border-0 btn-sm rounded-circle shadow-none" title="Delete">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-show="!categories.length">
                                        <td colspan="4">
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
                <!-- modal -->
                <div class="modal fade" id="categoryModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{ editMode ? "Edit" : "Add New"}}  Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form @submit.prevent=" editMode ? update() : store()" @keydown="form.onKeydown($event)">
                                <div class="modal-body">
                                    <alert-error :form="form" message="There were some problems with your input."></alert-error>
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input v-model="form.name" type="text" name="name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button :disabled="form.busy" type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                query : '',
                editMode : false,
                categories : [],
                form : new Form({
                    id : '',
                    name : ''
                }),
                pagination :{
                    current_page : 1,
                },
                currentUser : null,
                total : null,
                data :{
                    exportdata : []
                }
            }
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
        computed: {
            csvData() {
            return this.exportdata.map(item => ({
                ...item,
            }));
            }
        },
        <!--this mounted-->
        
        mounted() {
            
            console.log('Component mounted.')
            this.getData()
             axios.get("api/allcategory")
                    .then(res=>{
                       this.exportdata = res.data.data
                       //console.log(res.data.data)
                    })
                
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
                    link.setAttribute("download", "category.csv");
                    link.click();
                    
                },
            getData(){
                this.$Progress.start()
                axios.get('/api/category?page='+this.pagination.current_page)
                    .then(res=>{
                         //console.log(res)
                        this.categories = res.data.data
                        this.pagination = res.data.meta
                        this.total = res.data.meta.total
                        this.$Progress.finish()
                    })
                    .catch(e=>{
                        console.log(e)
                        this.$Progress.fail()
                    })
                },
                create(){
                     this.form.reset()
                    this.form.clear()
                    this.editMode = false
                    $('#categoryModalLong').modal('show');
                },
                store(){
                    this.$Progress.start()
                    this.form.busy = true
                    this.form.post('/api/category')
                        .then(res=>{
                            this.getData()
                            $('#categoryModalLong').modal('hide');
                            if(this.form.successful){
                            this.$Progress.finish();
                            this.$snotify.success('Category Add Successfully','Success')
                            }else{
                                this.$Progress.fail()
                                this.$snotify.error('Something wend wrong. Try aging','Error')
                            }
                        })
                        .catch(e=>{
                            console.log(e)
                            this.$Progress.fail()
                        })
                },
                edit(category){
                    this.editMode = true
                    this.form.reset()
                    this.form.clear()
                    this.form.fill(category)
                    $('#categoryModalLong').modal('show');
                },
                update(){
                    this.$Progress.start()
                    this.form.busy = true
                    this.form.put('/api/category/'+this.form.id)
                        .then(res=>{
                            this.getData()
                            $('#categoryModalLong').modal('hide');
                            if(this.form.successful){
                                this.$Progress.finish();
                                this.$snotify.success('Category Update Successfully','Success')
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
                destroy(category){

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
                                    //console.log(customer)
                                    this.$Progress.start()
                                    axios.delete('/api/category/'+category.id)
                                    .then(res=>{
                                        this.getData()
                                            this.$Progress.finish();
                                            this.$snotify.success('Category Delete Successfully','Success')
                                       
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
                },searchData(){
                    this.$Progress.start()
                    axios.get('/api/search/category/'+this.query+'?page='+this.pagination.current_page)
                        .then(res=>{
                            this.categories = res.data.data
                            this.pagination = res.data.meta
                            this.$Progress.finish()
                        })
                        .catch(e=>{
                            console.log(e)
                            this.$Progress.fail()
                        })
                    },
                    reload(){
                    this.getData()
                    this.query = ''
                    
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
