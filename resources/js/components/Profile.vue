<template>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded-lg border-0">
                    <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between" style="min-height: 70px;">
                        <h4 class="card-title mb-0 fw-bold text-dark" style="font-size: 1.7rem; letter-spacing: 0.5px;">
                            Profile
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row align-items-center g-2 mb-4">
                            <div class="col-md-3 text-center">
                                <img class="img-circle elevation-2 mb-3" :src="'./img/image.png'" alt="User Avatar" style="width: 100px; height: 100px; object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Name: </strong> {{ user.name }}</li>
                                    <li class="list-group-item"><strong>Email: </strong> {{ user.email }}</li>
                                    <li class="list-group-item"><strong>Role: </strong> {{ user.is_admin ? 'Admin' : 'Employee' }}</li>
                                    <li class="list-group-item"><strong>Created At: </strong> {{ user.created_at | mydate }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            user : []
        }
    },
    mounted(){
        //console.log(user)
        this.user = user
    }
}
</script>

<style>

</style>