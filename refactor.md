## Refactor förslag 1

Vi använder en HomeController för login men vi har också en som heter PagesController. Dessa två kan kombineras till en
fil för att öka läsbarheten. Detta innebär att vi kan plocka bort HomeController och blade template för att rensa upp
i vår kodbas.

## Refactor förslag 2

Alla stores i edit template är hårdkodade, det hade varit bättre om de var dynamiska. Om de är dynamiska så visas en ny
affär i listan så fort den läggs till i databasen. Men i denna edit.blade.php så måste en utvecklare manuellt gå in och
lägga till ny html kod för att den ska visas. Detta gör att utökningar i databasen blir ett mycket större jobb än om
det var dynamiskt kodat.
