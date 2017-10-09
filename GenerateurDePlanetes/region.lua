Region = {}
Region.__index = Region

function Region.new(x,y,ocean)

	local region = {}

	setmetatable(region, Region)

	region.altitude = 0

	region.precipitation = 0

	region.x = x

	region.y = y

	region.ocean = ocean

	region.biome = 0

	region.rouge = 0

	region.vert = 0

	region.bleu = 0

	region.sousRegions = {}

	return region

end

function Region:obtenirAltitude()

	return self.altitude

end

function Region:varierAltitude(variation)

	self.altitude = self.altitude + variation

end

function Region:obtenirPrecipitation()

	return self.precipitation

end

function Region:varierPrecipitation(variation)

	self.precipitation = self.precipitation + variation

end

function Region:setBiome()

	--print(self.precipitation)

	self.biome = ChoixDuBiome(self.precipitation,self.y,self.altitude,self.ocean)

end

function Region:setCouleur()

	if self.biome == "DesertFroid1" then
		self.rouge = 204
		self.vert = 204
		self.bleu = 204

	elseif self.biome == "DesertFroid2" then
		self.rouge = 217
		self.vert = 217
		self.bleu = 217

	elseif self.biome == "DesertFroid3" then
		self.rouge = 230
		self.vert = 230
		self.bleu = 230

	elseif self.biome == "TundraSec" then
		self.rouge = 102
		self.vert = 102
		self.bleu = 51

	elseif self.biome == "Tundra1" then
		self.rouge = 26
		self.vert = 51
		self.bleu = 0

	elseif self.biome == "Tundra2" then
		self.rouge = 40
		self.vert = 77
		self.bleu = 0

	elseif self.biome == "Tundra3" then
		self.rouge = 53
		self.vert = 102
		self.bleu = 0

	elseif self.biome == "Desert1" then
		self.rouge = 179
		self.vert = 179
		self.bleu = 0

	elseif self.biome == "Desert2" then
		self.rouge = 204
		self.vert = 204
		self.bleu = 0

	elseif self.biome == "Desert3" then
		self.rouge = 230
		self.vert = 230
		self.bleu = 0

	elseif self.biome == "Desert4" then
		self.rouge = 255
		self.vert = 255
		self.bleu = 0

	elseif self.biome == "Steppe" then
		self.rouge = 0
		self.vert = 153
		self.bleu = 51

	elseif self.biome == "ForetSeche1" then
		self.rouge = 115
		self.vert = 230
		self.bleu = 0

	elseif self.biome == "ForetSeche2" then
		self.rouge = 128
		self.vert = 255
		self.bleu = 0

	elseif self.biome == "MaquisDesert1" then
		self.rouge = 134
		self.vert = 179
		self.bleu = 0

	elseif self.biome == "MaquisDesert2" then
		self.rouge = 153 
		self.vert = 204
		self.bleu = 0

	elseif self.biome == "MaquisDesert3" then
		self.rouge = 172
		self.vert = 230
		self.bleu = 0

	elseif self.biome == "MaquisSec" then
		self.rouge = 153
		self.vert = 153
		self.bleu = 102

	elseif self.biome == "ForetTempere1" then
		self.rouge = 25
		self.vert = 77
		self.bleu = 25

	elseif self.biome == "ForetTempere2" then
		self.rouge = 31
		self.vert = 96
		self.bleu = 31

	elseif self.biome == "ForetTempere3" then
		self.rouge = 37
		self.vert = 116
		self.bleu = 37

	elseif self.biome == "ForetTempere4" then
		self.rouge = 43
		self.vert = 136
		self.bleu = 43

	elseif self.biome == "ForetHumide1" then
		self.rouge = 32
		self.vert = 96
		self.bleu = 64

	elseif self.biome == "ForetHumide2" then
		self.rouge = 38
		self.vert = 115
		self.bleu = 77

	elseif self.biome == "ForetHumide3" then
		self.rouge = 45
		self.vert = 134
		self.bleu = 89

	elseif self.biome == "ForetHumide4" then
		self.rouge = 51
		self.vert = 153
		self.bleu = 102

	elseif self.biome == "ForetPluviale1" then
		self.rouge = 0
		self.vert = 179
		self.bleu = 134

	elseif self.biome == "ForetPluviale2" then
		self.rouge = 0
		self.vert = 204
		self.bleu = 153

	elseif self.biome == "ForetTropicale1" then
		self.rouge = 0
		self.vert = 128
		self.bleu = 0

	elseif self.biome == "ForetTropicale2" then
		self.rouge = 0
		self.vert = 179
		self.bleu = 0

	elseif self.biome == "ForetTresSeche" then
		self.rouge = 153
		self.vert = 204
		self.bleu = 0

	elseif self.biome == "Maquis1" then
		self.rouge = 77
		self.vert = 102
		self.bleu = 0

	elseif self.biome == "Maquis2" then
		self.rouge = 115
		self.vert = 153
		self.bleu = 0

	elseif self.biome == "Ocean1" then
		self.rouge = 10
		self.vert = 30
		self.bleu = 200

	end

end

function Region:obtenirRouge()

	return self.rouge

end

function Region:obtenirVert()

	return self.vert

end

function Region:obtenirBleu()

	return self.bleu

end

function Region:genererSousRegions()

	for i=1,200 do

		self.sousRegions[i] = {}

		for j=1,200 do

			self.sousRegions[i][j] = SousRegion.new()

			self.sousRegions[i][j]:varierTerrain(love.math.random(1,4))

			self.sousRegions[i][j]:setColor()

		end

	end

end

function Region:draw()

	for i=1,200 do

		for j=1,200 do

			love.graphics.setColor(self.sousRegions[i][j]:obtenirRouge(), self.sousRegions[i][j]:obtenirVert(), self.sousRegions[i][j]:obtenirBleu() )

			love.graphics.rectangle("fill", i*5, j*5, 5, 5)

		end

	end

end