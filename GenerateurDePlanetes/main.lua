require "maths"
require "planete"
require "tableaux"
require "biomes"
require "region"
require "sous-region"

--[[
#################################################################
#################################################################
###############   love.load == initialisation   #################
############### Effectuée au début du programme #################
#################################################################
#################################################################

	lithosphere(INT): Tableau contenant l'altitude de chaque régions de la planète.

	precipitation(INT): Tableau contenant la pluie de chaque régions de la planète en mm par an.

	regions(OBJET): Tableau contenant les informations de chaques régions de la planète.

	rectangles(OBJET): Tableau contenant les pixels de la map à afficher.

]]

function love.load()

	planete1 = Planete.new()

	planete1:setAltitude()

	planete1:setErosion()

	planete1:setPrecipitation()

	planete1:setBiome()

	planete1.regions[1][1]:genererSousRegions()

	--[[

	for i=1,200 do

		for j=1,200 do

			planete1.regions[i][j]:genererSousRegions()

		end

	end

	]]

end

--[[
#################################################################
#################################################################
######### love.updated == Exécutée a chaque frame ###############
#########   Ne pas utiliser pour l'affichage      ###############
#################################################################
#################################################################
]]

function love.updated(dt)
	
end

--[[
#################################################################
#################################################################
#########     love.draw == Exécutée a chaque frame ##############
#########          A utiliser pour l'affichage     ##############
#################################################################
#################################################################
]]

function love.draw()
	
	planete1:draw()

	--planete1.regions[1][1]:draw()

end