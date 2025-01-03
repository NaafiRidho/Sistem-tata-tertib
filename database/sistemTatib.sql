USE [master]
GO
/****** Object:  Database [sistem-tata-tertib]    Script Date: 29/12/2024 23:02:33 ******/
CREATE DATABASE [sistem-tata-tertib]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'sistem-tata-tertib', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\sistem-tata-tertib.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'sistem-tata-tertib_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL16.MSSQLSERVER\MSSQL\DATA\sistem-tata-tertib_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
 WITH CATALOG_COLLATION = DATABASE_DEFAULT, LEDGER = OFF
GO
ALTER DATABASE [sistem-tata-tertib] SET COMPATIBILITY_LEVEL = 160
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [sistem-tata-tertib].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [sistem-tata-tertib] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET ARITHABORT OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [sistem-tata-tertib] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [sistem-tata-tertib] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET  DISABLE_BROKER 
GO
ALTER DATABASE [sistem-tata-tertib] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [sistem-tata-tertib] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET RECOVERY FULL 
GO
ALTER DATABASE [sistem-tata-tertib] SET  MULTI_USER 
GO
ALTER DATABASE [sistem-tata-tertib] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [sistem-tata-tertib] SET DB_CHAINING OFF 
GO
ALTER DATABASE [sistem-tata-tertib] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [sistem-tata-tertib] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [sistem-tata-tertib] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [sistem-tata-tertib] SET ACCELERATED_DATABASE_RECOVERY = OFF  
GO
EXEC sys.sp_db_vardecimal_storage_format N'sistem-tata-tertib', N'ON'
GO
ALTER DATABASE [sistem-tata-tertib] SET QUERY_STORE = ON
GO
ALTER DATABASE [sistem-tata-tertib] SET QUERY_STORE (OPERATION_MODE = READ_WRITE, CLEANUP_POLICY = (STALE_QUERY_THRESHOLD_DAYS = 30), DATA_FLUSH_INTERVAL_SECONDS = 900, INTERVAL_LENGTH_MINUTES = 60, MAX_STORAGE_SIZE_MB = 1000, QUERY_CAPTURE_MODE = AUTO, SIZE_BASED_CLEANUP_MODE = AUTO, MAX_PLANS_PER_QUERY = 200, WAIT_STATS_CAPTURE_MODE = ON)
GO
USE [sistem-tata-tertib]
GO
/****** Object:  Table [dbo].[admin]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[admin](
	[admin_id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [int] NULL,
	[nama] [varchar](max) NULL,
	[nip] [varchar](max) NULL,
 CONSTRAINT [PK_admin] PRIMARY KEY CLUSTERED 
(
	[admin_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[aju_banding]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[aju_banding](
	[banding_id] [int] IDENTITY(1,1) NOT NULL,
	[pelaporan_Id] [int] NULL,
	[admin-id] [int] NULL,
	[alasan] [varchar](max) NULL,
	[status] [varchar](max) NULL,
	[tanggal_pengajuan] [datetime] NULL,
 CONSTRAINT [PK_aju_banding] PRIMARY KEY CLUSTERED 
(
	[banding_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[document]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[document](
	[document_id] [int] IDENTITY(1,1) NOT NULL,
	[pelaporan_id] [int] NULL,
	[file] [varchar](max) NULL,
	[status] [varchar](100) NULL,
	[alasan] [varchar](max) NULL,
 CONSTRAINT [PK_document] PRIMARY KEY CLUSTERED 
(
	[document_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[dosen]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[dosen](
	[dosen_id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [int] NULL,
	[nama] [varchar](max) NULL,
	[nidn] [varchar](max) NULL,
 CONSTRAINT [PK_dosen] PRIMARY KEY CLUSTERED 
(
	[dosen_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[kelas]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[kelas](
	[kelas_id] [int] IDENTITY(1,1) NOT NULL,
	[dosen_id] [int] NULL,
	[nama_kelas] [varchar](50) NULL,
	[tahun_ajaran] [varchar](50) NULL,
	[prodi] [varchar](50) NULL,
 CONSTRAINT [PK_kelas] PRIMARY KEY CLUSTERED 
(
	[kelas_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[mahasiswa]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[mahasiswa](
	[mahasiswa_id] [int] IDENTITY(1,1) NOT NULL,
	[user_id] [int] NULL,
	[kelas_id] [int] NULL,
	[nama] [varchar](max) NULL,
	[nim] [varchar](max) NULL,
 CONSTRAINT [PK_mahasiswa] PRIMARY KEY CLUSTERED 
(
	[mahasiswa_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[pelanggaran]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[pelanggaran](
	[pelanggaran_id] [int] IDENTITY(1,1) NOT NULL,
	[tingkat_id] [int] NULL,
	[pelanggaran] [varchar](max) NULL,
 CONSTRAINT [PK_pelanggaran] PRIMARY KEY CLUSTERED 
(
	[pelanggaran_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[riwayat_pelaporan]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[riwayat_pelaporan](
	[pelaporan_id] [int] IDENTITY(1,1) NOT NULL,
	[dosen_id] [int] NULL,
	[mahasiswa_id] [int] NULL,
	[pelanggaran_id] [int] NULL,
	[tingkat_id] [int] NULL,
	[tanggal] [datetime] NULL,
	[status] [varchar](100) NULL,
	[file] [varchar](max) NULL,
 CONSTRAINT [PK_riwayat_pelaporan] PRIMARY KEY CLUSTERED 
(
	[pelaporan_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tingkat]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tingkat](
	[tingkat_id] [int] NOT NULL,
	[tingkat] [varchar](50) NULL,
	[sanksi] [varchar](max) NULL,
 CONSTRAINT [PK_tingkat] PRIMARY KEY CLUSTERED 
(
	[tingkat_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[user]    Script Date: 29/12/2024 23:02:34 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[user](
	[user_id] [int] IDENTITY(1,1) NOT NULL,
	[username] [varchar](50) NULL,
	[password] [varchar](50) NULL,
	[role] [varchar](50) NULL,
 CONSTRAINT [PK_user] PRIMARY KEY CLUSTERED 
(
	[user_id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[admin]  WITH CHECK ADD  CONSTRAINT [FK_admin_user] FOREIGN KEY([user_id])
REFERENCES [dbo].[user] ([user_id])
GO
ALTER TABLE [dbo].[admin] CHECK CONSTRAINT [FK_admin_user]
GO
ALTER TABLE [dbo].[aju_banding]  WITH CHECK ADD  CONSTRAINT [FK_admin_id] FOREIGN KEY([admin-id])
REFERENCES [dbo].[admin] ([admin_id])
GO
ALTER TABLE [dbo].[aju_banding] CHECK CONSTRAINT [FK_admin_id]
GO
ALTER TABLE [dbo].[aju_banding]  WITH CHECK ADD  CONSTRAINT [FK_pelaporan_id] FOREIGN KEY([pelaporan_Id])
REFERENCES [dbo].[riwayat_pelaporan] ([pelaporan_id])
GO
ALTER TABLE [dbo].[aju_banding] CHECK CONSTRAINT [FK_pelaporan_id]
GO
ALTER TABLE [dbo].[document]  WITH CHECK ADD  CONSTRAINT [FK_SuratPunishment] FOREIGN KEY([pelaporan_id])
REFERENCES [dbo].[riwayat_pelaporan] ([pelaporan_id])
GO
ALTER TABLE [dbo].[document] CHECK CONSTRAINT [FK_SuratPunishment]
GO
ALTER TABLE [dbo].[dosen]  WITH CHECK ADD  CONSTRAINT [FK_user_id] FOREIGN KEY([user_id])
REFERENCES [dbo].[user] ([user_id])
GO
ALTER TABLE [dbo].[dosen] CHECK CONSTRAINT [FK_user_id]
GO
ALTER TABLE [dbo].[kelas]  WITH CHECK ADD  CONSTRAINT [FK_dosen_id] FOREIGN KEY([dosen_id])
REFERENCES [dbo].[dosen] ([dosen_id])
GO
ALTER TABLE [dbo].[kelas] CHECK CONSTRAINT [FK_dosen_id]
GO
ALTER TABLE [dbo].[mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_kelas_id] FOREIGN KEY([kelas_id])
REFERENCES [dbo].[kelas] ([kelas_id])
GO
ALTER TABLE [dbo].[mahasiswa] CHECK CONSTRAINT [FK_kelas_id]
GO
ALTER TABLE [dbo].[mahasiswa]  WITH CHECK ADD  CONSTRAINT [FK_userid] FOREIGN KEY([user_id])
REFERENCES [dbo].[user] ([user_id])
GO
ALTER TABLE [dbo].[mahasiswa] CHECK CONSTRAINT [FK_userid]
GO
ALTER TABLE [dbo].[pelanggaran]  WITH CHECK ADD  CONSTRAINT [FK_tingkat_id] FOREIGN KEY([tingkat_id])
REFERENCES [dbo].[tingkat] ([tingkat_id])
GO
ALTER TABLE [dbo].[pelanggaran] CHECK CONSTRAINT [FK_tingkat_id]
GO
ALTER TABLE [dbo].[riwayat_pelaporan]  WITH CHECK ADD  CONSTRAINT [FK_dosenid] FOREIGN KEY([dosen_id])
REFERENCES [dbo].[dosen] ([dosen_id])
GO
ALTER TABLE [dbo].[riwayat_pelaporan] CHECK CONSTRAINT [FK_dosenid]
GO
ALTER TABLE [dbo].[riwayat_pelaporan]  WITH CHECK ADD  CONSTRAINT [FK_mahasiswa_id] FOREIGN KEY([mahasiswa_id])
REFERENCES [dbo].[mahasiswa] ([mahasiswa_id])
GO
ALTER TABLE [dbo].[riwayat_pelaporan] CHECK CONSTRAINT [FK_mahasiswa_id]
GO
ALTER TABLE [dbo].[riwayat_pelaporan]  WITH CHECK ADD  CONSTRAINT [FK_pelanggaran_id] FOREIGN KEY([pelanggaran_id])
REFERENCES [dbo].[pelanggaran] ([pelanggaran_id])
GO
ALTER TABLE [dbo].[riwayat_pelaporan] CHECK CONSTRAINT [FK_pelanggaran_id]
GO
ALTER TABLE [dbo].[riwayat_pelaporan]  WITH CHECK ADD  CONSTRAINT [FK_tingkatid] FOREIGN KEY([tingkat_id])
REFERENCES [dbo].[tingkat] ([tingkat_id])
GO
ALTER TABLE [dbo].[riwayat_pelaporan] CHECK CONSTRAINT [FK_tingkatid]
GO
USE [master]
GO
ALTER DATABASE [sistem-tata-tertib] SET  READ_WRITE 
GO
