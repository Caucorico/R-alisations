function ChoixDuBiome(pluie,y,alt,ocean)

	local biome 

	local latitude

	--print(pluie)

	if y <= 100 then

		latitude = (y/100) * 64  + love.math.random(0,3)

	else

		latitude = (64-( (y/200) * 64 ) )+ love.math.random(0,3) 

	end

	--print(lat)

	biome = Ocean1(biome,pluie,latitude,ocean,alt)

	return biome

end

function Ocean1(biome,pluie,latitude,ocean,alt)

	if ocean > alt then biome = "Ocean1"
	else biome = DesertFroid1(biome,pluie,latitude) end
	return biome

end

function DesertFroid1(biome,pluie,latitude)

	if pluie > 250 then biome=DesertFroid3(biome,pluie,latitude) 
	elseif pluie > 125 then biome=DesertFroid2(biome,pluie,latitude) 
	elseif latitude > 4 then biome=TundraSec(biome,pluie,latitude)
	else biome = "DesertFroid1" end
	return biome
end

function DesertFroid2(biome,pluie,latitude)

	if latitude > 4 then biome=TundraSec(biome,pluie,latitude)
	else biome = "DesertFroid2" end
	return biome
end

function DesertFroid3(biome,pluie,latitude)

	if latitude > 4 then biome=TundraSec(biome,pluie,latitude)
	else biome = "DesertFroid3" end
	return biome
end

function TundraSec(biome,pluie,latitude)

	if pluie > 500 then biome=Tundra3(biome,pluie,latitude) 
	elseif pluie > 250 then biome=Tundra2(biome,pluie,latitude) 
	elseif pluie > 125 then biome=Tundra1(biome,pluie,latitude) 
	elseif latitude > 8 then biome=Desert1(biome,pluie,latitude)
	else biome = "TundraSec" end
	return biome
end

function Tundra1(biome,pluie,latitude)

	if latitude > 8 then biome=Desert1(biome,pluie,latitude)
	else biome = "Tundra1" end
	return biome
end

function Tundra2(biome,pluie,latitude)

	if latitude > 8 then biome=Desert1(biome,pluie,latitude)
	else biome = "Tundra2" end
	return biome
end

function Tundra3(biome,pluie,latitude)

	if latitude > 8 then biome=Desert1(biome,pluie,latitude)
	else biome = "Tundra3" end
	return biome
end

function Desert1(biome,pluie,latitude)

	if pluie > 1000 then biome=ForetPluviale1(biome,pluie,latitude)
	elseif pluie > 500 then biome=ForetHumide1(biome,pluie,latitude)
	elseif pluie > 250 then biome=ForetTempere1(biome,pluie,latitude)
	elseif pluie > 125 then biome=MaquisSec(biome,pluie,latitude)
	elseif latitude > 16 then biome=Desert2(biome,pluie,latitude)
	else biome = "Desert1" end
	return biome
end

function MaquisSec(biome,pluie,latitude)

	if latitude > 16 then biome=Desert2(biome,pluie,latitude)
	else biome = "MaquisSec" end
	return biome
end

function ForetTempere1(biome,pluie,latitude)

	if latitude > 16 then biome=Desert2(biome,pluie,latitude)
	else biome = "ForetTempere1" end
	return biome
end

function ForetHumide1(biome,pluie,latitude)

	if latitude > 16 then biome=Desert2(biome,pluie,latitude)
	else biome = "ForetHumide1" end
	return biome
end

function ForetPluviale1(biome,pluie,latitude)

	if latitude > 16 then biome=Desert2(biome,pluie,latitude)
	else biome = "ForetPluviale1" end
	return biome
end

function Desert2(biome,pluie,latitude)
	if pluie > 2000 then biome=ForetPluviale2(biome,pluie,latitude)
	elseif pluie > 1000 then biome=ForetHumide2(biome,pluie,latitude)
	elseif pluie > 500 then biome=ForetTempere2(biome,pluie,latitude)
	elseif pluie > 250 then biome=Steppe(biome,pluie,latitude)
	elseif pluie > 125 then biome=MaquisDesert1(biome,pluie,latitude)
	elseif latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "Desert2" end
	return biome
end

function MaquisDesert1(biome,pluie,latitude)

	if latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "MaquisDesert1" end
	return biome
end

function Steppe(biome,pluie,latitude)

	if latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "Steppe" end
	return biome
end

function ForetTempere2(biome,pluie,latitude)

	if latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "ForetTempere2" end
	return biome
end

function ForetHumide2(biome,pluie,latitude)

	if latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "ForetHumide2" end
	return biome
end

function ForetPluviale2(biome,pluie,latitude)

	if latitude > 32 then biome=Desert3(biome,pluie,latitude)
	else biome = "ForetPluviale2" end
	return biome
end

function Desert3(biome,pluie,latitude)
	if pluie > 4000 then biome=ForetTropicale1(biome,pluie,latitude)
	elseif pluie > 2000 then biome=ForetHumide3(biome,pluie,latitude)
	elseif pluie > 1000 then biome=ForetTempere3(biome,pluie,latitude)
	elseif pluie > 500 then biome=ForetSeche1(biome,pluie,latitude)
	elseif pluie > 250 then biome=Maquis1(biome,pluie,latitude)
	elseif pluie > 125 then biome=MaquisDesert2(biome,pluie,latitude)
	elseif latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "Desert3" end
	return biome
end

function MaquisDesert2(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "MaquisDesert2" end
	return biome
end

function Maquis1(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "Maquis1" end
	return biome
end

function ForetSeche1(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "ForetSeche1" end
	return biome
end

function ForetTempere3(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "ForetTempere3" end
	return biome
end

function ForetHumide3(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "ForetHumide3" end
	return biome
end

function ForetTropicale1(biome,pluie,latitude)

	if latitude > 64 then biome=Desert4(biome,pluie,latitude)
	else biome = "ForetTropicale1" end
	return biome
end

function Desert4(biome,pluie,latitude)
	if pluie > 8000 then biome=ForetTropicale2(biome,pluie,latitude)
	elseif pluie > 4000 then biome=ForetHumide4(biome,pluie,latitude)
	elseif pluie > 2000 then biome=ForetTempere4(biome,pluie,latitude)
	elseif pluie > 1000 then biome=ForetSeche2(biome,pluie,latitude)
	elseif pluie > 500 then biome=ForetTresSeche(biome,pluie,latitude)
	elseif pluie > 250 then biome=Maquis2(biome,pluie,latitude)
	elseif pluie > 125 then biome=MaquisDesert3(biome,pluie,latitude)
	else biome = "Desert4" end
	return biome
end

function MaquisDesert3(biome,pluie,latitude)

	biome = "MaquisDesert3"
	return biome

end

function Maquis2(biome,pluie,latitude)

	biome = "Maquis2"
	return biome

end

function ForetTresSeche(biome,pluie,latitude)

	biome = "ForetTresSeche"
	return biome

end

function ForetSeche2(biome,pluie,latitude)

	biome = "ForetSeche2"
	return biome

end

function ForetTempere4(biome,pluie,latitude)

	biome = "ForetTempere4"
	return biome

end

function ForetHumide4(biome,pluie,latitude)

	biome = "ForetHumide4"
	return biome

end

function ForetTropicale2(biome,pluie,latitude)

	biome = "ForetTropicale2"
	return biome
end