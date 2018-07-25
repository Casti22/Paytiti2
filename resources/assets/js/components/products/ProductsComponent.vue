<template lang="html">
	<section>
		<div class="row">
			<product-card-component v-bind:product="product" v-for="product in products"></product-card-component>
			
		</div> 
	</section>
</template>

<script>
export default {
	data(){
		return {
			name: 'Products Component v2',
			products: [
				{title: 'Iphone 6', price: 70000, description: 'Una descripcion'},
				{title: 'Tarjeta GooglePlay', price: 2500, description: 'Una descripcion'},
			]
		}	
	}
}
</script>
