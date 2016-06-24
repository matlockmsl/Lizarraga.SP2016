angular.module("ABMangularPHP")
.directive("abmDirectiva", function()
{
	return	{
				template:"<div style='color:skyblue'>{{texto}}</div>",
				restrict:"EAC",
				scope:{texto:'='} 
			};
});