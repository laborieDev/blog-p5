#!/bin/bash

echo -e "Git update..."

getError() {
    echo "Une erreur s'est produite."
    echo "Réessayez ou contactez AGL Développement"
 }

echo -e "Tapez 1 pour récupérer les données du serveur"
echo -e "Tapez 2 pour ajouter vos données au serveur"
read choice
if [ $choice = 1 ]
then 
    echo -e "Saisir la branche concernée"
    read branche
    echo "Git pull ..."
    git pull origin $branche
elif [ $choice = 2 ]
then
    echo "Git add"
    git add --all
    echo -e "Saisir le message attribué au commit"
    read commitMessage
    echo "Git commit '$commitMessage'"
    git commit --m "$commitMessage"
    echo -e "Saisir la branche concernée"
    read branche
    echo "Git push ..."
    git checkout $branche
    git push origin $branche
else
    getError
fi



