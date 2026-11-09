<?php

use App\View\{Alert,Button,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container};

echo new Layout('Registerchoice',isset($loggedUser), [
        new Container('span',[
                new Hypertext('/registerteacher',['Professeur']
                ),new Hypertext('/registernotaffiliated',['Non affilier'])
        ])
]);
/*
<span>
    <ul>
        <a href="/registerteacher">Professeur</a>
        <a href="/registernotaffiliated">Non affilier</a>
    </ul>
</span>