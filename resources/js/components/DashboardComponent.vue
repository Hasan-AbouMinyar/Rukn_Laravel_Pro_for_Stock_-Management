<template>
  <div class="dashboard-modern-bg">
    <div class="dashboard-hero">
      <img class="dashboard-hero-img" src="/img/blueBack.png" alt="backgroundBlue" />
      <div class="dashboard-hero-overlay">
        <h1 class="dashboard-title">Welcome to Rkun | رُكن </h1>
        <p class="dashboard-subtitle">All your business insights in one beautiful place</p>
      </div>
    </div>
    <div class="dashboard-cards-container">
      <div class="dashboard-card" v-if="$profile.currentUser().is_admin">
        <div class="dashboard-card-icon admin">
          <i class="fas fa-user-plus"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label admin-label">{{ totalAdmin }}</h3>
          <p>Employee Type</p>
        </div>
        <router-link to="/user" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card customer">
        <div class="dashboard-card-icon customer">
          <i class="fas fa-users"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label customer-label">{{ totalCusomer }}</h3>
          <p>Total Customer</p>
        </div>
        <router-link to="/customer" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card supplier">
        <div class="dashboard-card-icon supplier">
          <i class="fas fa-industry"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label supplier-label">{{ totalSupplier }}</h3>
          <p>Total Supplier</p>
        </div>
        <router-link to="/supplier" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card category">
        <div class="dashboard-card-icon category">
          <i class="fas fa-tags"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label category-label">{{ totalCategory }}</h3>
          <p>Total Category</p>
        </div>
        <router-link to="/category" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card product">
        <div class="dashboard-card-icon product">
          <i class="fas fa-box"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label product-label">{{ totalProduct }}</h3>
          <p>Total Product</p>
        </div>
        <router-link to="/product" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card purchase">
        <div class="dashboard-card-icon purchase">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label purchase-label">{{ totalPurchase }}</h3>
          <p>Total Purchases</p>
        </div>
        <router-link to="/purchase" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
      <div class="dashboard-card sales">
        <div class="dashboard-card-icon sales">
          <i class="fas fa-chart-pie"></i>
        </div>
        <div class="dashboard-card-content">
          <h3 class="dashboard-label sales-label">{{ totalSales }}</h3>
          <p>Sales</p>
        </div>
        <router-link to="/sales" class="dashboard-card-link">More info <i class="fas fa-arrow-circle-right"></i></router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data(){
        return{

            totalAdmin : null,
            totalCusomer : null,
            totalSupplier : null,
            totalCategory : null,
            totalProduct : null,
            totalPurchase : null,
            totalSales : null,
        }
    },
     mounted(){
            console.log('Component mounted.')
            this.getAdmin()
            this.getCustomer()
            this.getSupplier()
            this.getCategory()
            this.getProduct()
            this.getPurchases()
            this.getSales()
            //console.log(this.$profile.currentUser())
        },
        methods:{
            getAdmin(){
                axios.get('/api/user')
                    .then(res=>{
                        this.totalAdmin = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getCustomer(){
                axios.get('/api/customer')
                    .then(res=>{
                        this.totalCusomer = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getSupplier(){
                axios.get('/api/supplier')
                    .then(res=>{
                        this.totalSupplier = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getCategory(){
                axios.get('/api/category')
                    .then(res=>{
                        this.totalCategory = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getProduct(){
                axios.get('/api/product')
                    .then(res=>{
                        this.totalProduct = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getPurchases(){
                axios.get('/api/purchase')
                    .then(res=>{
                        this.totalPurchase = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            },
            getSales(){
                axios.get('/api/sales')
                    .then(res=>{
                        this.totalSales = res.data.meta.total
                    })
                    .catch(e=>{
                        console.log(e)
                    })
            }
        }
}
</script>

<style scoped>
.dashboard-modern-bg {
  min-height: 100vh;
  background: linear-gradient(120deg, #f4f6f7 0%, #e9ecef 40%, #d5dbdb 100%);
  font-family: 'SF Pro Display', 'Segoe UI', Arial, sans-serif;
}
.dashboard-hero {
  position: relative;
  width: 100%;
  height: 320px;
  overflow: hidden;
  border-radius: 0 0 32px 32px;
  margin-bottom: 40px;
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
}
.dashboard-hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.7) blur(1px);
}
.dashboard-hero-overlay {
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: #fff;
  background: rgba(0,0,0,0.25);
  text-shadow: 0 2px 8px rgba(0,0,0,0.2);
}
.dashboard-title {
  font-size: 2.8rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  letter-spacing: 1px;
}
.dashboard-subtitle {
  font-size: 1.2rem;
  font-weight: 400;
  opacity: 0.9;
}
.dashboard-cards-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 32px;
  margin-top: -60px;
  padding: 0 2vw 40px 2vw;
}
.dashboard-card {
  background: #fff;
  border-radius: 24px;
  box-shadow: 0 8px 32px 0 rgba(40, 116, 166, 0.05);
  backdrop-filter: blur(8px);
  min-width: 260px;
  max-width: 320px;
  flex: 1 1 260px;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 32px 24px 24px 24px;
  transition: transform 0.2s, box-shadow 0.2s;
  position: relative;
}
.dashboard-card:hover {
  transform: translateY(-8px) scale(1.03);
  box-shadow: 0 16px 40px 0 rgba(40, 116, 166, 0.10);
  background: #fff;
}
.dashboard-card-icon {
  font-size: 2.5rem;
  width: 72px;
  height: 72px;
  background: none;
  border-radius: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 18px;
  overflow: visible;
  box-shadow: none;
  color: #707B7C;
}
.dashboard-card-icon.admin {
  color: #707B7C;
}
.dashboard-card-icon.customer {
  color: #707B7C;
}
.dashboard-card-icon.supplier {
  color: #707B7C;
}
.dashboard-card-icon.category {
  color: #707B7C;
}
.dashboard-card-icon.product {
  color: #707B7C;
}
.dashboard-card-icon.purchase {
  color: #707B7C;
}
.dashboard-card-icon.sales {
  color: #707B7C;
}
.dashboard-card-content {
  text-align: center;
  margin-bottom: 12px;
}
.dashboard-card-content h3 {
  font-size: 2.2rem;
  font-weight: 700;
  margin: 0 0 0.2em 0;
  color: #222;
  background: #fff;
  border-radius: 8px;
  padding: 2px 12px;
  display: inline-block;
}
.dashboard-label {
  font-size: 2.2rem;
  font-weight: 700;
  margin: 0 0 0.2em 0;
  color: #7b7d7d;
  background: #fff;
  border-radius: 8px;
  padding: 2px 12px;
  display: inline-block;
}
.admin-label {
  color: #7b7d7d;
}
.customer-label {
  color: #a6acaf;
}
.supplier-label {
  color: #b2babb;
}
.category-label {
  color: #85929e;
}
.product-label {
  color: #cacfd2;
}
.purchase-label {
  color: #abb2b9;
}
.sales-label {
  color: #566573;
}
.dashboard-card-content p {
  font-size: 1.1rem;
  color: #555;
  margin: 0;
  background: #fff;
  border-radius: 6px;
  padding: 2px 8px;
  display: inline-block;
}
.dashboard-card-link {
  display: inline-block;
  margin-top: 8px;
  color: #222;
  font-weight: 500;
  text-decoration: none;
  font-size: 1rem;
  transition: color 0.2s;
}
.dashboard-card-link:hover {
  color: #2874A6;
  text-decoration: underline;
}
@media (max-width: 900px) {
  .dashboard-cards-container {
    gap: 18px;
  }
  .dashboard-card {
    min-width: 180px;
    padding: 20px 10px 16px 10px;
  }
}
@media (max-width: 600px) {
  .dashboard-hero {
    height: 180px;
    border-radius: 0 0 18px 18px;
  }
  .dashboard-title {
    font-size: 1.5rem;
  }
  .dashboard-cards-container {
    flex-direction: column;
    align-items: center;
    gap: 12px;
    margin-top: -30px;
  }
  .dashboard-card {
    min-width: 90vw;
    max-width: 98vw;
    padding: 4vw 2vw 2vw 2vw;
  }
}
</style>