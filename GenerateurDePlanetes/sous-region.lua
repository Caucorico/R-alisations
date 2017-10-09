SousRegion = {}
SousRegion.__index = SousRegion

function SousRegion.new()

	local sousRegion = {}

	setmetatable(sousRegion,SousRegion)

	sousRegion.rouge = 0

	sousRegion.vert = 0

	sousRegion.bleu = 0

	sousRegion.terrain = "Rien"

	return sousRegion

end

function SousRegion:varierTerrain(numSousRegion)

	if numSousRegion == 1 then

		terrain = "Arbre"

	elseif numSousRegion == 2 then

		terrain = "Plaine"

	elseif numSousRegion == 3 then

		terrain = "Colline"

	else

		terrain = "Rocher"

	end

	self.terrain = terrain

end

function SousRegion:setColor()

	if self.terrain == "Arbre" then

		self.rouge = 0
		self.vert = 102
		self.bleu = 0

	elseif self.terrain == "Plaine" then

		self.rouge = 51
		self.vert = 204
		self.bleu = 51

	elseif self.terrain == "Colline" then

		self.rouge = 102
		self.vert = 102
		self.bleu = 51

	else

		self.rouge = 100
		self.vert = 100
		self.bleu = 100

	end

end

function SousRegion:obtenirRouge()

	return self.rouge
	
end

function SousRegion:obtenirVert()

	return self.vert

end

function SousRegion:obtenirBleu()

	return self.bleu

end