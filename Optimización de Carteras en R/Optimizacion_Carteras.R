#install.packages("quantmod")
#install.packages("PerformanceAnalytics")
#install.packages("PortfolioAnalytics")
#install.packages("ROI.plugin.quadprog")
#install.packages("ROI.plugin.glpk")
library(quantmod)
library(ggplot2)
library(PerformanceAnalytics)
library(PortfolioAnalytics)
library(ROI.plugin.quadprog)
library(ROI.plugin.glpk)
library(readxl)
library(xts)

# Obtener datos de las empresas de Enero 2020 a Abril 2025
# Apple
getSymbols("AAPL", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(AAPL, "AAPL_data.csv")

# Microsoft
getSymbols("MSFT", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(MSFT, "MSFT_data.csv")

# Amazon
getSymbols("AMZN", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(AMZN, "AMZN_data.csv")

# Meta
getSymbols("META", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(META, "META_data.csv")

# NVIDIA
getSymbols("NVDA", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(NVDA, "NVDA_data.csv")

# Tesla
getSymbols("TSLA", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(TSLA, "TSLA_data.csv")

# Adobe
getSymbols("ADBE", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(ADBE, "ADBE_data.csv")

# Intel
getSymbols("INTC", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(INTC, "INTC_data.csv")

# Netflix
getSymbols("NFLX", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(NFLX, "NFLX_data.csv")

# AMD
getSymbols("AMD", src = "yahoo", from = "2020-01-01", to = "2025-04-01")
write.csv(AMD, "AMD_data.csv")

# Lista de empresas 
empresas <- c("AAPL", "MSFT", "AMZN", "META", "NVDA", "TSLA", "ADBE", "INTC", "NFLX", "AMD")


# Lista para almacenar datos y retornos
datos_empresas <- list()
retornos_empresas <- list()
rendimiento <- list()
riesgo<- list()

# Cargar los datos en la lista y cálculo de retornos
for (empresa in empresas) {
  datos_empresas[[empresa]] <- get(empresa) 
  precios_xts <- (Cl(datos_empresas[[empresa]]) / Op(datos_empresas[[empresa]]))
  retornos_empresas[[empresa]] <- na.omit(Return.calculate(Ad(datos_empresas[[empresa]])))+1
  rendimiento[[empresa]] <-mean(na.omit(precios_xts))
  riesgo[[empresa]]<-var(na.omit(precios_xts))
}

rendimiento
riesgo

# Mostrar los primeros valores de los retornos de cada empresa
for (empresa in empresas) {
  cat("\nRetornos de", empresa, ":\n")
  print(head(retornos_empresas[[empresa]]))
}


par(mfrow = c(2, 5), mar = c(2, 2, 2, 1)) 

# Graficar los retornos y la media para cada empresa
for (empresa in empresas) {
  if (!is.null(retornos_empresas[[empresa]])) {
    ret <- retornos_empresas[[empresa]]
    media_ret <- mean(ret, na.rm = TRUE)
    plot.zoo(ret,
             main = empresa,
             ylab = "Retorno",
             xlab = "",
             ylim = range(ret, na.rm = TRUE))
    
    abline(h = media_ret, col = "red", lty = 2, lwd = 2)
  }
}


# Crear un objeto xts con los retornos de todas las empresas
retornos_xts <- do.call(merge, retornos_empresas)

################################################################################
################################ PORTFOLIO #####################################
################################################################################

# Definir la especificación del portafolio para todas las empresas
portSpec0 <- portfolio.spec(colnames(retornos_xts))

############################## Restricciones ###################################

portSpec0 <- add.constraint(portfolio = portSpec0, type = "full_investment")
portSpec0 <- add.constraint(portfolio = portSpec0, type = "long_only")

############################# Funcion objetivo #################################

# Objetivo: Minimizar riesgo
portMinRisk <- add.objective(portfolio = portSpec0, type = "risk", name = "StdDev")

############################### Optimizacion ###################################

optMinRisk <- optimize.portfolio(R = retornos_xts, portfolio = portMinRisk, 
                                 optimize_method = "ROI")

# Pesos óptimos
while (!is.null(dev.list())) dev.off()
dev.new()  
par(mfrow = c(1, 1))
chart.Weights(optMinRisk)
pesos <- optMinRisk$weights
print(round(pesos, 4))

# Valor óptimo de la función objetivo
print(optMinRisk$objective_measures)

# Retorno mínimo
medias <- colMeans(retornos_xts, na.rm = TRUE)
minReturn <- sum(pesos * medias, na.rm = TRUE)

# Filtrar activos con pesos positivos y significativos
filtered_weights <- optMinRisk$weights[optMinRisk$weights > 1e-3]

# Crear un dataframe con los datos ajustados
weights_df <- data.frame(
  Activo = names(filtered_weights),
  Peso = filtered_weights*100
)

# Gráfico distribución de la inversión en la cartera óptima
ggplot(weights_df, aes(x = Activo, y = Peso)) +
  geom_bar(stat = "identity", fill = "skyblue") +
  geom_text(aes(label = paste0(round(Peso, 2), "%")), vjust = -0.5, size = 3.5) +
  labs(title = "Distribución de la inversión en la Cartera Óptima",
       y = "Peso (%)",
       x = "Activo") +
  theme_minimal() +
  theme(axis.text.x = element_text(angle = 45, hjust = 1))

########################## DOBLE OBJETIVO: MEAN-RISK ###########################
#Objetivo 1: Maximizar el retorno medio esperado de la cartera.
portMeanRisk <- add.objective(portfolio = portSpec0, type = "return", name = "mean")
#Objetivo 2: Minimizar el riesgo
portMeanRisk <- add.objective(portfolio = portMeanRisk, type = "risk", name = "StdDev", 
                              risk_aversion = 10)
optMeanRisk <- optimize.portfolio(R = retornos_xts, portfolio = portMeanRisk, 
                                  optimize_method = "ROI")
print(optMeanRisk)

# Diversificacion: 1 - sum(w^2)
diversificacion <- diversification(optMeanRisk$weights)
# Mayor diversificacion: (Depende del numero de activos)
# El maximo para n activos: 1 - 1/n
max <- 1 - 1/7
diversificacionRelativa <- diversificacion/max
############################ FRONTERA EFICIENTE ################################
n <- 200
riskAversion <- exp(seq(log(0.001), log(1000000), length.out = n))
fronteraEficiente <- data.frame(Return = numeric(n), Risk = numeric(n), SR = numeric(n))

for (i in 1:n) {
  portMeanRisk <- portfolio.spec(colnames(retornos_xts))
  portMeanRisk <- add.constraint(portfolio = portMeanRisk, type = "full_investment")
  portMeanRisk <- add.constraint(portfolio = portMeanRisk, type = "long_only")
  portMeanRisk <- add.objective(portfolio = portMeanRisk, type = "return", name = "mean")
  portMeanRisk <- add.objective(portfolio = portMeanRisk, type = "risk", name = "StdDev", risk_aversion = riskAversion[i])
  optMeanRisk <- optimize.portfolio(R = retornos_xts, portfolio = portMeanRisk, optimize_method = "ROI")
  fronteraEficiente$Return[i] <- optMeanRisk$objective_measures$mean
  fronteraEficiente$Risk[i] <- optMeanRisk$objective_measures$StdDev
}
fronteraEficiente <- na.omit(fronteraEficiente)

# Sharpe ratio
rf <- 0.9995
fronteraEficiente$SR <- (fronteraEficiente$Return - rf) / fronteraEficiente$Risk

# Portafolio que maximiza el Sharpe ratio
maxSR <- fronteraEficiente[which.max(fronteraEficiente$SR), ]
maxSR

weights <- extractWeights(optMeanRisk)
weights<-weights[extractWeights(optMeanRisk) > 1e-3]  
weights

# Crear un data frame con los datos de cada activo
asset_data <- data.frame(
  Risk = apply(retornos_xts, 2, sd, na.rm = TRUE),
  Return = medias,
  Label = colnames(retornos_xts)
)

# Graficar la frontera eficiente con los puntos de cada activo
ggplot(fronteraEficiente, aes(x = Risk, y = Return)) +
  geom_line(color = "blue", size = 1) +
  geom_point(aes(x = maxSR$Risk, y = maxSR$Return), color = "red", size = 3) +
  geom_text(aes(x = maxSR$Risk, y = maxSR$Return, label = "Máx. SR"), vjust = 0) +
  geom_point(data = asset_data, mapping = aes(x = Risk, y = Return), color = "black", size = 2) +
  geom_text(data = asset_data, mapping = aes(x = Risk, y = Return, label = Label), vjust = 1.5, size = 3) +
  labs(title = "Frontera Eficiente", x = "Riesgo", y = "Retorno") +
  theme_minimal()
