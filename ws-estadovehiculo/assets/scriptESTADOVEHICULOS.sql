USE [KAO_wssp]
GO
/****** Object:  Table [dbo].[CAB_estado_vehiculo]    Script Date: 22/7/2019 13:04:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CAB_estado_vehiculo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [nchar](10) NOT NULL,
	[placa] [nchar](8) NULL,
	[kilometraje] [nchar](10) NULL,
	[encargado] [nchar](10) NULL,
	[asignadoA] [nchar](10) NULL,
	[fecha] [date] NULL,
	[observacion] [nchar](100) NULL,
	[estado] [int] NULL,
 CONSTRAINT [PK_CAB_estado_vehiculo] PRIMARY KEY CLUSTERED 
(
	[codigo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ITEMS_estado_vehiculos]    Script Date: 22/7/2019 13:04:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ITEMS_estado_vehiculos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [nchar](10) NOT NULL,
	[descripcion] [nchar](100) NULL,
	[activo] [bit] NULL,
 CONSTRAINT [PK_ITEMS_estado_vehiculos] PRIMARY KEY CLUSTERED 
(
	[codigo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[MOV_estado_vehiculo]    Script Date: 22/7/2019 13:04:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[MOV_estado_vehiculo](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [nchar](10) NULL,
	[item] [nchar](10) NULL,
	[valor] [nchar](10) NULL
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[CAB_estado_vehiculo] ON 

INSERT [dbo].[CAB_estado_vehiculo] ([id], [codigo], [placa], [kilometraje], [encargado], [asignadoA], [fecha], [observacion], [estado]) VALUES (1, N'EST0001   ', N'PBQ1254 ', N'138339    ', N'1600505505', N'1600505505', CAST(N'2019-07-16' AS Date), N'Test                                                                                                ', 1)
SET IDENTITY_INSERT [dbo].[CAB_estado_vehiculo] OFF
SET IDENTITY_INSERT [dbo].[ITEMS_estado_vehiculos] ON 

INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (1, N'ITEM0001  ', N'Espejo lateral derecho                                                                              ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (2, N'ITEM0002  ', N'Esoejo lateral izquierdo                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (3, N'ITEM0003  ', N'Espejo retrovisor                                                                                   ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (4, N'ITEM0004  ', N'Moquetas                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (5, N'ITEM0005  ', N'Limpiadores                                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (6, N'ITEM0006  ', N'Claxon                                                                                              ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (7, N'ITEM0007  ', N'Viseras (x2)                                                                                        ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (8, N'ITEM0008  ', N'Palanca de Velocidad                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (9, N'ITEM0009  ', N'Cinturones de seguridad                                                                             ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (10, N'ITEM0010  ', N'Antena                                                                                              ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (11, N'ITEM0011  ', N'Radio                                                                                               ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (12, N'ITEM0012  ', N'Manijas                                                                                             ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (13, N'ITEM0013  ', N'Guantera                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (15, N'ITEM0014  ', N'Seguros de las puertas                                                                              ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (16, N'ITEM0015  ', N'Calefaccion                                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (17, N'ITEM0016  ', N'Luces de tablero                                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (18, N'ITEM0017  ', N'Luces piloto y marcadores del tablero                                                               ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (19, N'ITEM0018  ', N'Estribo                                                                                             ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (20, N'ITEM0019  ', N'Llaves                                                                                              ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (21, N'ITEM0020  ', N'Llantas                                                                                             ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (22, N'ITEM0021  ', N'Parabrisas                                                                                          ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (23, N'ITEM0022  ', N'Caja de herramientas                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (24, N'ITEM0023  ', N'Cristales de puertas (laterales)                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (25, N'ITEM0024  ', N'Encendedor                                                                                          ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (26, N'ITEM0025  ', N'Faros                                                                                               ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (27, N'ITEM0026  ', N'Molduras                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (28, N'ITEM0027  ', N'Direccionales                                                                                       ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (29, N'ITEM0028  ', N'Defensas (Delantera/Posterior)                                                                      ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (30, N'ITEM0029  ', N'Luces del Furgon                                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (31, N'ITEM0030  ', N'Llanta de emergencia                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (32, N'ITEM0031  ', N'Tapones de ruedas                                                                                   ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (33, N'ITEM0032  ', N'Tapa de gasolina                                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (34, N'ITEM0033  ', N'Tapa de radiador                                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (35, N'ITEM0034  ', N'Tapa de aceite                                                                                      ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (36, N'ITEM0035  ', N'Aire acondicionado                                                                                  ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (37, N'ITEM0036  ', N'Tapiceria de asientos                                                                               ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (38, N'ITEM0037  ', N'Tapiceria de puertas                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (39, N'ITEM0038  ', N'Pedales                                                                                             ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (40, N'ITEM0039  ', N'Candados                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (41, N'ITEM0040  ', N'Palancas de direccionales y plumas                                                                  ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (42, N'ITEM0041  ', N'Bayoneta aceite                                                                                     ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (43, N'ITEM0042  ', N'Llave de cruz                                                                                       ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (44, N'ITEM0043  ', N'Gata                                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (45, N'ITEM0044  ', N'Reflectivos                                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (46, N'ITEM0045  ', N'Extintor                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (47, N'ITEM0046  ', N'Botiquin                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (48, N'ITEM0047  ', N'Palanca de fuerza de llanta                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (49, N'ITEM0048  ', N'Palanca para la gata                                                                                ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (50, N'ITEM0049  ', N'Persiana                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (51, N'ITEM0050  ', N'Placa delantera                                                                                     ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (52, N'ITEM0051  ', N'Placa trasera                                                                                       ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (53, N'ITEM0052  ', N'Baterias                                                                                            ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (54, N'ITEM0053  ', N'Tapas de espejos                                                                                    ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (55, N'ITEM0054  ', N'Luz interior                                                                                        ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (56, N'ITEM0055  ', N'Porta Vasos                                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (57, N'ITEM0056  ', N'Agarraderas                                                                                         ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (58, N'ITEM0057  ', N'Parlantes                                                                                           ', 1)
INSERT [dbo].[ITEMS_estado_vehiculos] ([id], [codigo], [descripcion], [activo]) VALUES (59, N'ITEM0058  ', N'Emblemas                                                                                            ', 1)
SET IDENTITY_INSERT [dbo].[ITEMS_estado_vehiculos] OFF
