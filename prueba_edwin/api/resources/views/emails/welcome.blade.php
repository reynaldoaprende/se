<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	.header{
		background-color: #004a87;
		padding-top: 10px;
		padding-bottom: 10px;
		margin-right: 10px;
		margin-top: 15px;
		margin-bottom: 15px;
		width: 100%;

		-webkit-border-radius: 50px;
		-moz-border-radius: 50px;
		border-radius: 50px;



	}
	.header .logo{
		display: block;
		margin: 0 auto;
	}
	.container{
		padding: 10px;
	}
	a{
		text-decoration: none;
	}
	.confirm{
		display: block;
		font-family: "Arial";
		color: white;
		background-color: rgb(238, 36, 42);
		-webkit-border-radius: 50px;
		-moz-border-radius: 50px;
		border-radius: 50px;
		cursor: pointer;
		margin:0 auto;
		font-size: 17px;
		font-weight: 400;
		height: 40px;
		border: white 2px solid;
		padding-top: 10px;
		padding-bottom:20px;
		padding-left: 15px;
		padding-right: 15px;
		text-decoration: none;
	}

	.description{
		padding: 10px;
	}
	.description .container .paragraph{
		text-align: justify;
		font-family: "Arial";
		font-size: 24px;
		font-weight: 400
	}
	.description .container .title{
		font-family: "Arial";
		font-size: 24px;
		font-weight: 400
	}
	.logo{
		height: 60px;
		margin:0 auto;
	}
	.legal{
		text-align: justify;
	}
</style>
</head>
<body>

	<div class="description">
		<div class="header">
			<img class="logo" src="https://cdn.unimagdalena.edu.co/images/escudo/bg_dark/default.png">
		</div>
		<div class="container">
			<p class="paragraph">
				Hola, {{$fullname}}
			</p>
			<p class="paragraph">
				Bienvenido a SGR.
			</p>
		</div>
	</div>

</body>
</html>