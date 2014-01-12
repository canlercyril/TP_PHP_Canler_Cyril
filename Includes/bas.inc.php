      <!-- contenu -->
              <meta charset="utf-8">
          
          </div>
          
		  
		  
		  
		  
          
			<?php
			//On teste si l'utilisateur est identifié
            if (identification()==true)
{


?>
				<!-- Menu affiché aux utilisateurs identifiés --> 
				<nav class="span4">
				<h2>Menu</h2>
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="connexion.php?deconnexion">Deconnexion</a></li>
					<li><a href="article.php">Rédiger un article</a></li>
					
					</form>	</li>
				</ul>
				<?php
				}
else
{
?>
				<!-- Menu affiché aux utilisateurs non identifiés --> 
				<nav class="span4">
				<h2>Menu</h2>
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="connexion.php">Connexion</a></li>
					<li><a href="inscription.php">Inscription</a></li>
					
					
					</form>	</li>
				</ul>
				<?php

}
				?>
				
			<!-- Fonction recherche --> 
			<form method="GET" action="index.php">  
			
			<input type="text" name="recherche"/><br />
			
			<input type="submit" value="rechercher" name="" class="btn btn-large btn-primary"/>
			

			
            
          </nav>
        </div>
        
      </div>

      <footer>
        <p>&copy; MaGiiC</p>

      </footer>

    </div>

  </body>
</html>

