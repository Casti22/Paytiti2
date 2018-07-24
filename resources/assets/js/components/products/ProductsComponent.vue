<template lang="html">
	<section>
		<div class="row">
			<div v-for="product in products" class="col-xs-12 col-sm-10 col-md-4">
				<div class="card">
					<header class="bg-primary padding">

					</header>

					<div class="card-body padding">
						<h2 class="card-title">{{product.title}}</h2>
						<h4 class="card-subtitle">{{product.price}}</h4>
						<p class="card-text">{{product.description}}</p>
					</div>

				</div>
			</div>
		
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
