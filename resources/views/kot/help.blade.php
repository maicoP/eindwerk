@extends('app')
@section('title')
	KOTTER - Help &amp; Contact
@stop
@section('content')
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
					<li><a href="#">Help &amp; Contact</a></li>
				</ul>

				<div class="row-fluid">
					<div class="span13">
						<h1>Help</h1>

						
						<h2><br>Verificatiesysteem</h2>

Om de kwaliteit van de koten in de applicatie te garanderen, gaat het Kotter-team koten individueel bekijken vooraleer ze in de app worden toegevoegd. 
Indien een kot aan alle voorwaarden voldoet, zullen wij het goedkeuren en zal het kot in de app verschijnen. Een verificatie gebeurt binnen 24u. Terwijl een kot gereviewed wordt, zal het opgelijst worden onder 'in review' in het kotenoverzicht. Indien een kot wordt afgekeurd zullen wij een reden geven waarom. Het kot wordt dan opgelijst onder de 'geweigerde koten'.

						<h1><br>Handleiding</h1>

						<h2><br>Koten toevoegen</h2>

Een kot toevoegen doet u via het menu in de zijbalk genaamd 'kot toevoegen'. Het proces wijst zichzelf uit. Het enige wat we nodig hebben, zijn alle gegevens en 4 kwaliteitsvolle foto's die een beeld geven van het kot. (Een foto met een breedhoeklens/fisheye heeft de voorkeur aangezien deze meer kunnen laten zien binnenin een kamer.)

<br><u>Prijs</u><br>
Elk kot moet verplicht de totaalprijs laten zien. Indien een vaste totale prijs niet mogelijk is bij een kot, moet er een geschatte totale prijs gegeven worden (vink hiervoor ook het veld 'schatting' aan). Deze geschatte prijs moet zo realistisch mogelijk zijn. Misbruik hiervan zal worden bestraft.

						<h2><br>Koten bewerken</h2>

Als u een aanpassing wil doen aan een bestaand kot (inclusief foto's aanpassen, contactgegevens aanpassen,..), dan kan u dat zeer eenvoudig door naar het kotenoverzicht te gaan en onder het kot in kwestie op de 'edit' knop te klikken.

						<h2><br>Koten deleten</h2>

Indien u een kot permanent wenst te verwijderen uit de app, dan kan u dit doen door naar het kotenoverzicht te gaan en onder het bewuste kot op de 'delete' knop te klikken.

						<h1><br>Richtlijnen koten</h1>

						<ul>
						<li>Het kot heeft een minimum oppervlakte van 10 m²</li>
						<li>De kotprijs is een totaalprijs met alle kosten inbegrepen. Dit mag ook een schatting zijn</li>
						<li>Het kot bevindt zich in zeer goede staat</li>
						<li>Het kot beschikt over 4 duidelijke foto's</li>
						</ul>

						<h1><br>Contact</h1>

						Voor meer informatie of extra vragen kan u ons steeds contacteren via mail: <a href="mailto:info@kotterapp.be">info@kotterapp.be</a>.<br>						
					</div><!--end koten-->
				</div>
			</div><!--end content-->
		</div><!--end row fluid-->
	</div><!--end container fluid-->

@endsection
