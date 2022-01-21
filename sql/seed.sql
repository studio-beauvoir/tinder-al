-- GENDERS TABLE
INSERT INTO `genre` (`idGenr`, `libGenr`) VALUES
(1,'Homme')
,(2,'Femme')
,(3,'Cis, cisgenre')
,(4,'Trans*, trans, transgenre, transidentitaire, transsexuel')
,(5,'En questionnement')
,(6,'Queer')
,(7,'Non-binaire')
,(8, 'Agenre, neutrois')
,(9, 'Bigenre, trigenre')
,(10, 'Intergenre')
,(11, 'Demi-boy, demi-girl')
,(12, 'Genderfluid, genre fluide, genderqueer')
,(13, 'Genre non conforme')
,(14, 'Troisième genre')
,(15, 'Pangenre, ultigenre, omnigenre')
,(16, 'Shemale')
;
-- USER table
INSERT INTO `user` (`idUser`, `idGenr`, `nomEUser`, `prenomUser`, `photo`, `age`, `biographie`) VALUES
(1, 2,'Coquard', 'Leily', 'https://thispersondoesnotexist.com/', 20, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(2, 2, 'Telusma', 'Mia', 'https://thispersondoesnotexist.com/', 18,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(3, 1, 'Proust', 'Arthaud', 'https://thispersondoesnotexist.com/', 18,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(4, 2, 'Bornerie', 'Martine', 'https://thispersondoesnotexist.com/', 45,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(5, 1, 'Judic', 'Gwendal', 'https://thispersondoesnotexist.com/', 22,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(6, 5, 'Nago', 'Jason', 'https://thispersondoesnotexist.com/', 23,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(7, 1, 'Lust', 'Maxime', 'https://thispersondoesnotexist.com/', 19,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
,(8, 1,'Wegera', 'Quentin', 'https://thispersondoesnotexist.com/', 19,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ita fit beatae vitae domina fortuna, quam Epicurus ait exiguam intervenire sapienti.')
;
