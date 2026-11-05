<?php
use App\Tags\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container};

echo new Layout('Nous contacter',isset($loggedUser),[
new Container('section',[
        new Title(1,['Nous contacter !']),
    new Paragraph(['Vous pouvez nous retrouver toutes les 
        semaines du lundi au vendredi à l\'IUT 
        d\'Aix-en-Provence.'])
],'class=contact')
]);
