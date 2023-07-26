<template>
        <!-- footer part start-->
	<footer class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-6 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>about us</h4>
					<p>Heaven fruitful doesn't over the lesser days appear cree ping seasons so behold bea Place likeness female form. Lesser Was green image lights fowl.</p>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Contact Info</h4>
					<ul>
						<li><p>Address :Your address goes
								here, your demo address.</p></li>
						<li><p>Phone : +8880 44338899</p></li>
						<li><p>Email : info@colorlib.com</p></li>
					</ul>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Important Link</h4>
					<ul>
						<li v-if="store.state.token==null" >
							<router-link :to="{name:'login'}"  >Login</router-link >
						</li>
						<li v-if="store.state.token==null" >
							<router-link :to="{name:'register'}">Register</router-link >
						</li>
						<li >
							<router-link :to="{name:'contact'}">Contact</router-link>
						</li>
						<li >
							<router-link :to="{name:'createPost'}" >Create</router-link>
						</li>
						<li >
							<router-link v-if="store.state.token !=null" 
							@click="store.dispatch('FETCH_POSTS_PROFILE',store.state.user_id_auth)" 
							:to="{name:'profile',params:{id:store.state.user_id_auth}}" >Profile
						   </router-link >
						</li>
						<li><a href="/">Home</a></li>
						
					</ul>
				</div>
				<div class="col-xl-3 col-lg-6 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
					<h4>Newsletter</h4>
					<p>Heaven fruitful doesn't over lesser in days. Appear creeping seasons deve behold bearing days open</p>
					<div class="form-wrap" id="mc_embed_signup">
						<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
							<input class="form-control" v-model="email" name="EMAIL" placeholder="Your Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"  type="email">
							<button  @click.prevent="saveMsg()" class="click-btn btn btn-default text-uppercase"><i class="ti-arrow-right"></i></button>
							<div style="position: absolute; left: -5000px;">
								<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
							</div>

							<div class="info"></div>
						</form>
					</div>
				</div>
			</div>
			<div class="copyright_text">
				<div class="row  align-items-center justify-content-center">
					<div class="col-lg-8" >
						<div class="copyright_part">
							<p class="footer-text m-0">Copyright © 2023 All rights reserved 
								<span class="px-2">|</span> This Site is Made with <i class="ti-heart"></i> by <a href="http://colorlib.com">Younes Elyoussoufi</a></p>
						</div>
					</div>
					<div class="col-lg-4 text-center text-lg-right">
						<div class="footer-social">
							<a href="#"><i class="ti-facebook"></i></a>
							<a href="#"> <i class="ti-twitter"></i> </a>
							<a href="#"><i class="ti-instagram"></i></a>
							<a href="#"><i class="ti-skype"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</template>

<script setup>
 import {useStore } from 'vuex'
 import {ref } from 'vue'
 import Message from '../store/Message';

const store=useStore()
const email=ref('')
const saveMsg=()=>{
	if (email.value!='') {
	Message('message saved ','success','green')
		
	} else {
	Message('email required ','error','red')
		
	}
} 
</script>

<style scoped>

/* footer */
footer .brand{
    font-family: var(--lg-font);
    letter-spacing: 2px;
}
footer a{
    -webkit-transition: color 0.3s ease;
    -o-transition: color 0.3s ease;
    transition: color 0.3s ease;
}
footer a:hover{
    color: var(--pink)!important;
}

#copyRight{
    background-color: #000;
}

</style>