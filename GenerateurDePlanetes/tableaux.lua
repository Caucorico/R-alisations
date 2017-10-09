

--[[
#################################################################
#################################################################
####  Tablzr == Initialise un tableau à zéro et le retourne  ####
####                                                         ####
####      Prend en argument la taille du tableau voulu       ####
####                                                         ####
####  Postcondition : Le tableau est bien initialisé à zéro  ####
#################################################################
#################################################################


]]

function tableauDeZero(taillex,tailley)

	local tableau = {}

	for i=1,taillex do

			tableau[i] = {}
			
		for j=1,tailley do

			tableau[i][j] = 0

		end

	end

	return tableau

end